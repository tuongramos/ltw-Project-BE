<?php

class UserService {

    private $repository;

    public function __construct() {
        $this->repository = new UserRepository();
    }

    public function getAll() {
        $rows = $this->repository->findAll();
        return array_map(function ($row) {
            return UserMapper::toDTO($row);
        }, $rows);
    }

    public function getById($id) {
        $row = $this->repository->findById($id);
        if (!$row) return null;
        return UserMapper::toDTO($row);
    }

    public function login($username, $password) {
        if (empty($username) || empty($password)) {
            throw new Exception('Username và Password không được để trống');
        }

        $row = $this->repository->findByUsername(trim($username));
        if (!$row) {
            throw new Exception('Username không tồn tại');
        }

        if (!password_verify($password, $row['password'])) {
            throw new Exception('Mật khẩu không chính xác');
        }

        // Đăng nhập thành công, trả về thông tin user (đã lược bỏ password thông qua DTO)
        return UserMapper::toDTO($row);
    }

    public function create($data) {
        // Validate dữ liệu bắt buộc
        if (empty($data['username'])) {
            throw new Exception('Username không được để trống');
        }
        if (empty($data['email'])) {
            throw new Exception('Email không được để trống');
        }
        if (empty($data['password'])) {
            throw new Exception('Password không được để trống');
        }

        // Kiểm tra username đã tồn tại chưa
        $existing = $this->repository->findByUsername(trim($data['username']));
        if ($existing) {
            throw new Exception('Username đã tồn tại');
        }

        // Hash password trước khi lưu
        $hashedPassword = password_hash($data['password'], PASSWORD_DEFAULT);

        $result = $this->repository->create(
            trim($data['username']),
            trim($data['email']),
            $hashedPassword,
            isset($data['first_name']) ? trim($data['first_name']) : null,
            isset($data['last_name']) ? trim($data['last_name']) : null,
            isset($data['phone_number']) ? trim($data['phone_number']) : null,
            isset($data['address']) ? trim($data['address']) : null,
            isset($data['sex']) ? trim($data['sex']) : null,
            isset($data['role']) ? trim($data['role']) : 'USER'
        );

        if ($result) {
            return true;
        }
        return false;
    }

    public function update($id, $data) {
        // Kiểm tra user có tồn tại không
        $existing = $this->repository->findById($id);
        if (!$existing) {
            return null;
        }

        // Chỉ cập nhật fields được gửi lên, giữ nguyên giá trị cũ nếu không gửi
        $username = isset($data['username']) ? trim($data['username']) : $existing['username'];
        $email = isset($data['email']) ? trim($data['email']) : $existing['email'];
        $first_name = isset($data['first_name']) ? trim($data['first_name']) : $existing['first_name'];
        $last_name = isset($data['last_name']) ? trim($data['last_name']) : $existing['last_name'];
        $phone_number = isset($data['phone_number']) ? trim($data['phone_number']) : $existing['phone_number'];
        $address = isset($data['address']) ? trim($data['address']) : $existing['address'];
        $sex = isset($data['sex']) ? trim($data['sex']) : $existing['sex'];
        $role = isset($data['role']) ? trim($data['role']) : $existing['role'];

        // Chỉ hash password nếu có gửi password mới
        if (!empty($data['password'])) {
            $password = password_hash($data['password'], PASSWORD_DEFAULT);
        } else {
            $password = $existing['password'];
        }

        // Nếu update username, cần check xem có bị trùng với user khác không
        if ($username !== $existing['username']) {
             $checkUsername = $this->repository->findByUsername($username);
             if ($checkUsername && $checkUsername['id'] != $id) {
                 throw new Exception('Username đã tồn tại');
             }
        }

        return $this->repository->update(
            $id,
            $username,
            $email,
            $password,
            $first_name,
            $last_name,
            $phone_number,
            $address,
            $sex,
            $role
        );
    }

    public function delete($id) {
        // Kiểm tra user có tồn tại không
        $existing = $this->repository->findById($id);
        if (!$existing) {
            return false;
        }

        return $this->repository->delete($id);
    }
}
?>
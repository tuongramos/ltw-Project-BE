-- =============================================
-- Dữ liệu mẫu cho Web Bán Đồ Thể Thao
-- Chạy file này SAU KHI đã chạy schema.sql
-- =============================================

USE sports_shop_db;

-- -----------------------------------------
-- Dữ liệu mẫu: Danh mục
-- -----------------------------------------
INSERT INTO categories (name, slug, description) VALUES
('Vợt Cầu Lông', 'vot-cau-long', 'Các loại vợt cầu lông chính hãng từ nhiều thương hiệu'),
('Áo Cầu Lông', 'ao-cau-long', 'Áo thể thao chuyên dụng cho cầu lông'),
('Quần Cầu Lông', 'quan-cau-long', 'Quần thể thao chuyên dụng cho cầu lông'),
('Giày Cầu Lông', 'giay-cau-long', 'Giày cầu lông chống trượt, bám sân tốt'),
('Phụ Kiện', 'phu-kien', 'Phụ kiện cầu lông: cước, grip, bao vợt, cầu lông');

-- -----------------------------------------
-- Dữ liệu mẫu: Sản phẩm
-- -----------------------------------------
INSERT INTO products (category_id, name, brand, description, price, sale_price, discount, image, stock, status) VALUES
-- Vợt Cầu Lông (category_id = 1)
(1, 'Vợt Cầu Lông Astrox 99 Pro', 'YONEX', 'Vợt cầu lông cao cấp, thiên công, thích hợp cho người chơi nâng cao. Trọng lượng 83g, căng tối đa 30lbs.', 4200000, 3850000, 8, 'https://via.placeholder.com/300x300?text=Astrox+99+Pro', 25, 1),
(1, 'Vợt Cầu Lông Nanoflare 700', 'YONEX', 'Vợt siêu nhẹ, thiên tốc độ, phù hợp đánh đôi. Trọng lượng 78g.', 3500000, 3200000, 9, 'https://via.placeholder.com/300x300?text=Nanoflare+700', 30, 1),
(1, 'Vợt Cầu Lông Axforce 80', 'Lining', 'Vợt cao cấp dòng Axforce, cân bằng công thủ. Trọng lượng 85g.', 3800000, 3500000, 8, 'https://via.placeholder.com/300x300?text=Axforce+80', 20, 1),
(1, 'Vợt Cầu Lông Thruster K Falcon', 'Victor', 'Vợt công thủ toàn diện, khung carbon siêu bền.', 2900000, 2650000, 9, 'https://via.placeholder.com/300x300?text=Thruster+K', 15, 1),

-- Áo Cầu Lông (category_id = 2)
(2, 'Áo Cầu Lông AAYP061-1', 'Lining', 'Áo thể thao nam, chất liệu polyester thoáng mát, co giãn 4 chiều.', 99000, 69000, 30, 'https://via.placeholder.com/300x300?text=Ao+Lining+1', 100, 1),
(2, 'Áo Cầu Lông AAYS011', 'Lining', 'Áo thể thao nữ, thiết kế trẻ trung, thấm hút mồ hôi tốt.', 120000, 89000, 26, 'https://via.placeholder.com/300x300?text=Ao+Lining+2', 80, 1),
(2, 'Áo Cầu Lông 10560TR', 'YONEX', 'Áo thi đấu chính hãng Yonex, công nghệ Very Cool Dry.', 890000, 790000, 11, 'https://via.placeholder.com/300x300?text=Ao+Yonex', 40, 1),

-- Giày Cầu Lông (category_id = 4)
(4, 'Giày Cầu Lông Power Cushion 65Z3', 'YONEX', 'Giày cao cấp, đệm Power Cushion+, đế cao su non chống trượt.', 3200000, 2900000, 9, 'https://via.placeholder.com/300x300?text=Giay+65Z3', 35, 1),
(4, 'Giày Cầu Lông AYAR033-1', 'Lining', 'Giày nhẹ, đế carbon chống xoắn, ôm chân tốt.', 1800000, 1550000, 14, 'https://via.placeholder.com/300x300?text=Giay+Lining', 50, 1),

-- Phụ Kiện (category_id = 5)
(5, 'Cước Cầu Lông BG65', 'YONEX', 'Cước đánh phổ biến nhất thế giới, bền, đàn hồi tốt. Đường kính 0.70mm.', 85000, NULL, 0, 'https://via.placeholder.com/300x300?text=Cuoc+BG65', 200, 1);

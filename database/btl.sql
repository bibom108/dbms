-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Máy chủ: 127.0.0.1
-- Thời gian đã tạo: Th12 03, 2022 lúc 02:17 AM
-- Phiên bản máy phục vụ: 10.4.21-MariaDB
-- Phiên bản PHP: 7.3.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Cơ sở dữ liệu: `btl`
--

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `accept`
--

CREATE TABLE `accept` (
  `time` date NOT NULL,
  `course_id` varchar(7) NOT NULL,
  `student_id` varchar(7) NOT NULL,
  `customer_serice_id` varchar(7) NOT NULL,
  `time_acc` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Đang đổ dữ liệu cho bảng `accept`
--

INSERT INTO `accept` (`time`, `course_id`, `student_id`, `customer_serice_id`, `time_acc`) VALUES
('2019-09-09', '1112223', '8364046', '4455667', '2019-09-12'),
('2020-10-10', '1112345', '1122334', '4466677', '2020-10-13');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `at`
--

CREATE TABLE `at` (
  `num` varchar(7) NOT NULL,
  `branch_id` varchar(7) NOT NULL,
  `course_id` varchar(7) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Đang đổ dữ liệu cho bảng `at`
--

INSERT INTO `at` (`num`, `branch_id`, `course_id`) VALUES
('1000201', '1000000', '1112223'),
('1000201', '1000000', '1238899'),
('1000202', '1000000', '1112345'),
('1000202', '1000000', '1124455'),
('1000203', '1000000', '1122447'),
('1000203', '1000000', '1124990'),
('1000204', '1000000', '1122356'),
('2000201', '2000000', '1234455'),
('5000201', '5000000', '1122337');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `branch`
--

CREATE TABLE `branch` (
  `branch_id` varchar(7) NOT NULL,
  `address` varchar(255) DEFAULT NULL,
  `manager_id` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Đang đổ dữ liệu cho bảng `branch`
--

INSERT INTO `branch` (`branch_id`, `address`, `manager_id`) VALUES
('1000000', 'Phường 10 Quận 10 TP HCM', '6611311'),
('2000000', 'Phường 8 Quận 5 TP ', '6622322'),
('5000000', 'Phường 12 Quận Bình Thạnh TP HCM', '6633333');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `classroom`
--

CREATE TABLE `classroom` (
  `num` varchar(7) NOT NULL,
  `capacity` int(11) NOT NULL,
  `branch_id` varchar(7) NOT NULL
) ;

--
-- Đang đổ dữ liệu cho bảng `classroom`
--

INSERT INTO `classroom` (`num`, `capacity`, `branch_id`) VALUES
('1000201', 15, '1000000'),
('1000202', 15, '1000000'),
('1000203', 15, '1000000'),
('1000204', 15, '1000000'),
('2000201', 15, '2000000'),
('5000201', 15, '5000000');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `course`
--

CREATE TABLE `course` (
  `course_id` varchar(7) NOT NULL,
  `start_date` date DEFAULT NULL,
  `level` varchar(255) DEFAULT NULL,
  `fee` varchar(255) DEFAULT NULL,
  `name` varchar(255) DEFAULT NULL,
  `length` varchar(255) DEFAULT NULL,
  `time` varchar(255) DEFAULT NULL,
  `manager_id` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Đang đổ dữ liệu cho bảng `course`
--

INSERT INTO `course` (`course_id`, `start_date`, `level`, `fee`, `name`, `length`, `time`, `manager_id`) VALUES
('1112223', '2021-11-30', 'Beginner', '1000000', 'MOS', '8', '18:00:00', '6611211'),
('1112345', '2021-12-10', 'Beginner', '2000000', 'Beginner for ReactJS', '10', '18:00:00', '6611211'),
('1122337', '2021-12-15', 'Advanced', '10000000', 'The Completed 2023 Web Development Bootcamp', '14', '18:00:00', '6611211'),
('1122356', '2021-12-10', 'Elementary', '2500000', 'AJAX Development', '11', '20:00:00', '6611211'),
('1122447', '2021-12-15', 'Advanced', '10000000', 'React - The Completed Guide', '14', '20:00:00', '6611211'),
('1124455', '2021-11-30', 'Beginner', '1500000', 'Javascript for Beginner', '9', '20:00:00', '6611211'),
('1124990', '2021-12-10', 'Intermediate', '4000000', 'The Web Developer Bootcamp 2022', '10', '18:00:00', '6611211'),
('1234455', '2021-12-15', 'Upper Intermediate', '6000000', 'Using Python to Interact with the Operating', '12', '18:00:00', '6611211'),
('1238899', '2021-12-10', 'Beginner', '4000000', 'Beginner for C#', '10', '20:00:00', '6611211');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `customer_serice`
--

CREATE TABLE `customer_serice` (
  `customer_serice_id` varchar(7) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Đang đổ dữ liệu cho bảng `customer_serice`
--

INSERT INTO `customer_serice` (`customer_serice_id`) VALUES
('4455667'),
('4466677'),
('4477677'),
('4488677'),
('4499677');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `manager`
--

CREATE TABLE `manager` (
  `manager_id` varchar(7) NOT NULL,
  `dept` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Đang đổ dữ liệu cho bảng `manager`
--

INSERT INTO `manager` (`manager_id`, `dept`) VALUES
('6611211', 'Quản lí khoá học'),
('6611311', 'Quản lí chi nhánh'),
('6622322', 'Quản lí chi nhánh'),
('6633333', 'Quản lí chi nhánh');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `request`
--

CREATE TABLE `request` (
  `time` date NOT NULL,
  `course_id` varchar(7) NOT NULL,
  `student_id` varchar(7) NOT NULL,
  `content` text DEFAULT NULL,
  `status` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Đang đổ dữ liệu cho bảng `request`
--

INSERT INTO `request` (`time`, `course_id`, `student_id`, `content`, `status`) VALUES
('2019-09-09', '1112223', '8364046', 'Thay đổi giờ học sang 20h', 0),
('2020-10-10', '1112345', '1122334', 'Thay đổi giờ học sang 18h', 1);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `result`
--

CREATE TABLE `result` (
  `student_id` varchar(7) NOT NULL,
  `course_id` varchar(7) NOT NULL,
  `score` int(11) NOT NULL,
  `comment` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Đang đổ dữ liệu cho bảng `result`
--

INSERT INTO `result` (`student_id`, `course_id`, `score`, `comment`) VALUES
('1112223', '1124455', 10, 'Xuất Sắc'),
('1112233', '1124990', 9, 'Giỏi tiếp tục cố gắng'),
('1122334', '1112345', 8, 'Tốt'),
('1223456', '1122337', 6, 'Trung Bình cần nổ lực thêm'),
('1233456', '1122447', 8, 'Tốt'),
('1234455', '1234455', 10, 'Xuất Sắc'),
('1234566', '1122356', 10, 'Xuất Sắc'),
('1234567', '1238899', 10, 'Xuất Sắc'),
('1239999', '1112345', 9, 'Tốt'),
('1239999', '1122447', 8, 'Cần ôn lại kiến thức căn bản'),
('1239999', '1124455', 10, 'Giỏi'),
('8364046', '1112223', 9, 'Giỏi');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `review`
--

CREATE TABLE `review` (
  `student_id` varchar(7) NOT NULL,
  `course_id` varchar(7) NOT NULL,
  `content` text DEFAULT NULL,
  `time` date NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Đang đổ dữ liệu cho bảng `review`
--

INSERT INTO `review` (`student_id`, `course_id`, `content`, `time`) VALUES
('1112223', '1124455', 'Khóa học tuyệt vời', '2022-12-02'),
('1112233', '1124990', 'Khóa học tuyệt vời', '2022-12-02'),
('1122334', '1112345', 'Khóa học đầy đủ tư liệu', '2022-12-02'),
('1223456', '1122337', 'Khóa học đầy đủ tư liệu', '2022-12-02'),
('1233456', '1122447', 'Khóa học đầy đủ tài liệu', '2022-12-02'),
('1234455', '1234455', 'Khóa học tuyệt vời', '2022-12-02'),
('1234566', '1122356', 'Khóa học chi tiết và có hướng dẫn học sinh', '2022-12-02'),
('1234567', '1238899', 'Khóa học đầy đủ tài liệu', '2022-12-02'),
('8364046', '1112223', 'Khóa học tuyệt vời', '2022-12-02');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `schedule`
--

CREATE TABLE `schedule` (
  `course_id` varchar(7) NOT NULL,
  `class_date` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Đang đổ dữ liệu cho bảng `schedule`
--

INSERT INTO `schedule` (`course_id`, `class_date`) VALUES
('1112223', 'Thứ 2'),
('1112345', 'Thứ 3'),
('1122337', 'Thứ 2'),
('1122356', 'Thứ 4'),
('1122447', 'Thứ 5'),
('1124455', 'Thứ 6'),
('1124990', 'Thứ 7'),
('1234455', 'Chủ nhật'),
('1238899', 'Thứ 3');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `staff`
--

CREATE TABLE `staff` (
  `staff_id` varchar(7) NOT NULL,
  `dob` varchar(255) DEFAULT NULL,
  `gender` varchar(255) DEFAULT NULL,
  `name` varchar(255) NOT NULL,
  `role` varchar(255) NOT NULL,
  `phone` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `address` varchar(255) DEFAULT NULL,
  `branch_id` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Đang đổ dữ liệu cho bảng `staff`
--

INSERT INTO `staff` (`staff_id`, `dob`, `gender`, `name`, `role`, `phone`, `email`, `address`, `branch_id`) VALUES
('4455667', '1993-09-09', 'Nữ', 'Nguyễn Thị Hằng', 'Chăm sóc khách hàng', '0378555555', 'hangnguyencskh@gmail.com', 'Phường 6 Quận Tân Phú TP HCM', '1000000'),
('4466677', '1992-08-08', 'Nam', 'Nguyễn Hồng Sơn', 'Chăm sóc khách hàng', '0987746111', 'sonnguyencskh@gmail.com', 'Phường 17 Quận Bình Thạnh TP HCM', '1000000'),
('4477677', '1990-07-07', 'Nam', 'Phạm Văn Nhân', 'Chăm sóc khách hàng', 'Phường 15 Quận 5 TPHCM', '0987746222', 'nhanphamcskh@gmail.com', '1000000'),
('4488677', '1992-06-15', 'Nam', 'Duy Thanh Hào', 'Chăm sóc khách hàng', '0375890000', 'haoduycskh@gmail.com', 'Phường 18 Quận 10 TP HCM', '1000000'),
('4499677', '1995-09-11', 'Nam', 'Võ Văn Thành', 'Chăm sóc khách hàng', '0977774444', 'thanhvocskh@gmail.com', 'Phường 11 Quận 4 TP HCM', '1000000'),
('5511211', '1990-07-12', 'Nam', 'Nguyễn Trọng Nhân', 'Giáo viên', '0944443333', 'nhannguyengv@gmail.com', 'Phường 8 Quận 8 TP HCM', '1000000'),
('5522222', '1992-02-02', 'Nữ', 'Phạm Thanh Thảo', 'Giáo viên', '0976555555', 'thaophamgv@gmail.com', 'Phường 11 Quận 11 TP HCM', '1000000'),
('5533233', '1995-03-04', 'Nữ', 'Tom Hiddleston', 'Giáo viên', '0986855555', 'duyenvogv@gmail.com', 'Phường 9 Quận 12 TP HCM', '1000000'),
('5544244', '1989-04-04', 'Nữ', 'Tom Brian', 'Giáo viên', '0948484848', 'nguyentrangv@gmail.com', 'Phường 11 Quận 12 TP HCM', '1000000'),
('5555255', '1990-07-12', 'Nam', 'Đinh Văn Diệp', 'Giáo viên', '0958585858', 'diepdinhgv@gmail.com', 'Phường 9 Quận 2 TP HCM', '1000000'),
('6611211', '1990-09-09', 'Nam', 'Trần Ngọc Sơn', 'Quản lý khóa học', '0973737373', 'sontranqlkh@gmail.com', 'Phường 9 Quận 1 TP HCM', '1000000'),
('6611311', '1985-08-18', 'Nam', 'Đinh Văn Tuấn', 'Quản lý chi nhánh', '0971717171', 'tuandinhqlcn@gmail.com', 'Phường 10 Quận 10 TP HCM', '1000000'),
('6622322', '1989-07-17', 'Nam', 'Nguyễn Văn Hào', 'Quản lý chi nhánh', '0988991212', 'haonguyenqlcn@gmail.com', 'Phường Tân Tạo Quận Bình Tân TP HCM', '2000000'),
('6633333', '1987-06-16', 'Nam', 'Trần Đình Thảo', 'Quản lý chi nhánh', '0979792222', 'thaotranqlcn@gmail.com', 'Phường 1 Quận 1 TP HCM', '5000000');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `student`
--

CREATE TABLE `student` (
  `student_id` varchar(7) NOT NULL,
  `name` varchar(55) NOT NULL,
  `address` varchar(255) DEFAULT NULL,
  `dob` date DEFAULT NULL,
  `age` varchar(3) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Đang đổ dữ liệu cho bảng `student`
--

INSERT INTO `student` (`student_id`, `name`, `address`, `dob`, `age`) VALUES
('1112222', 'Võ Xuân Dũng', 'Phường Tân Tạo Quận Bình Tân TP HCM', '1995-05-25', '27'),
('1112223', 'Nguyễn Trọng Nhật', 'Phường 9 Quận 9 TP HCM', '2000-03-03', '22'),
('1112233', 'Huỳnh Bá Đạt', 'Phường Tân Tạo Quận Bình Tân TP HCM', '2000-04-15', '22'),
('1122334', 'Nguyễn Thị Thu Hiền', 'Phường 9 Quận 6 TP HCM', '1996-03-15', '26'),
('1223456', 'Nguyễn Thị Kiều Hạnh', 'Phường 6 Quận 5 TP HCM', '2001-08-19', '21'),
('1233456', 'Nguyễn Quốc Trọng', 'Phường Linh Trung Quận Thủ Đức TP HCM', '2001-11-02', '21'),
('1234455', 'Hoàng Thị Hồng Sơn', 'Phường 18 Quận Bình Thạnh TP HCM', '2001-07-16', '21'),
('1234556', 'Phạm Phương Linh', 'Phường 8 Quận 8 TP HCM', '2004-09-09', '18'),
('1234566', 'Đinh Lệ Trân', 'Phường 12 Quận 10 TP HCM', '2001-06-15', '21'),
('1234567', 'Nguyễn Duy Nhật', 'Phường 12 Quận 7 TP HCM', '2001-07-15', '21'),
('1235555', 'Phạm Việt Cường', 'Phường 1 Quận 1 TP HCM', '2001-03-13', '21'),
('1236666', 'Lê Mậu Phúc Khang', 'Phường 3 Quận 2 TP HCM', '2001-06-20', '21'),
('1237777', 'Nguyễn Anh Văn', 'Phường Tân Thành Quận Tân Phú TP HCM', '2001-08-18', '21'),
('1238888', 'Bùi Thanh Duy', 'Phường Linh Trung Quận Thủ Đức TP HCM', '2001-09-19', '21'),
('1239999', 'Hồ Hoàng Huy', 'Phường 15 Quận Tân Phú TP HCM', '2001-11-01', '21'),
('2341111', 'Võ Thị Mỹ Duyên', 'Phường 7 Quận 5 TP HCM', '2000-07-07', '22'),
('2342222', 'Bùi Bảo Yến', 'Phường 13 Quận 3 TP HCM', '2005-08-08', '17'),
('2343333', 'Lương Thị Hoài Mỹ', 'Phường Tây Thạnh Quận Tân Phú TP HCM', '2006-09-09', '16'),
('2344444', 'Lê Thủy Ánh', 'Phường 7 Quận 4 TP HCM', '1992-01-02', '30'),
('2345555', 'Lê Thị Ngọc Nhung', 'Phường 16 Quận 1 TP HCM', '1995-03-04', '27'),
('2346666', 'Nguyễn Thị Cẩm Ly', 'Phường Linh Chiểu Quận Thủ Đức TP HCM', '2004-05-15', '18'),
('2347777', 'Hà Giang Phạm', 'Phường Linh Tây Quận Thủ Đức TP HCM', '1999-09-19', '23'),
('2348888', 'Mai Công Nam', 'Phường 10 Quận 10 TP HCM', '2001-01-01', '21'),
('2349999', 'Nguyễn Tấn Lộc', 'Phường 7 Quận 7 TP HCM', '2001-05-05', '21'),
('3341111', 'Trúc Linh Dương', 'Phường 25 Quận Bình Thạnh TP HCM', '2004-01-01', '18'),
('3342222', 'Hồ Thị Hảo', 'Phường 26 Quận Bình Thạnh TP HCM', '2005-02-03', '17'),
('3343333', 'Nguyễn Bá Lực', 'Phường 17 Quận 1 TP HCM', '2000-07-23', '22'),
('3344444', 'Trần Mỹ Nga', 'Phường 21 Quận 2 TP HCM', '2001-02-02', '21'),
('3345555', 'Nguyễn Thanh Tâm', 'Phường 9 Quận 12 TP HCM', '2007-04-04', '15'),
('4070813', 'Ho Hoang Huy', NULL, NULL, NULL),
('4164135', 'Ho Hoang Huy', NULL, NULL, NULL),
('4267415', 'Ho Hoang Huy', NULL, NULL, NULL),
('4301106', 'Hoàng Huy Huy', NULL, NULL, NULL),
('4602633', '', NULL, NULL, NULL),
('4809557', 'Ho Hoang Huy', NULL, NULL, NULL),
('5284785', '', NULL, NULL, NULL),
('5321395', '', NULL, NULL, NULL),
('5814944', 'hohoh', NULL, NULL, NULL),
('7018283', 'Ho Hoang Huy', NULL, NULL, NULL),
('7143770', 'Hoàng Huy Huy', NULL, NULL, NULL),
('7431024', 'Ho Hoang Huy', NULL, NULL, NULL),
('7872445', '', NULL, NULL, NULL),
('8364046', 'Nguyễn Quốc Hùng', 'Phường 8 Quận 6 TP HCM', '1999-09-09', '23'),
('8364064', 'Nguyễn Quốc Hùng', 'Phường 8, Quận 6 TPHCM\r\n', '2001-07-16', NULL),
('9439571', 'Ho Hoang Huy', NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `studentt18`
--

CREATE TABLE `studentt18` (
  `student_id` varchar(7) NOT NULL,
  `email` varchar(255) NOT NULL,
  `phone` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Đang đổ dữ liệu cho bảng `studentt18`
--

INSERT INTO `studentt18` (`student_id`, `email`, `phone`) VALUES
('1112222', 'xuandungqb@gmail.com', '0378444433'),
('1112223', 'trongnhat@gmail.com', '0999345678'),
('1112233', 'huynhdatdat@gmail.com', '0944443333'),
('1122334', 'hien.nguyen@gmail.com', '0956727272'),
('1223456', 'hanh.nguyenhanh@gmail.com', '0378881055'),
('1233456', 'trong09001@gmail.com', '0358888999'),
('1234455', 'son.sonson@gmail.com', '0909202020'),
('1234566', 'dinhletran01@gmail.com', '0374455667'),
('1234567', 'nhatson@gmail.com', '0999897999'),
('1235555', 'phamcuong0505@gmail.com', '0376555555'),
('1236666', 'phuckhanglemau@gmail.com', '0999777777'),
('1237777', 'vannguyen0721@gmail.com', '0976543210'),
('1238888', 'duybui.longan@gmail.com', '0977999977'),
('1239999', 'huy.ho@gmail.com', '0345678910'),
('2341111', 'duyen.euh@gmail.com', '0999124578'),
('2344444', 'thuyphamcenter@gmail.com', '0365544112'),
('2345555', 'nhungngoc.le@gmail.com', '0345566778'),
('2347777', 'hagiang.hg@gmail.com', '0999999999'),
('2348888', 'congnam.cgnam@gmail.com', '0333333333'),
('2349999', 'tanlocxd@gmail.com', '0345777777'),
('3343333', 'nguyenluchutech@gmail.com', '0945454545'),
('3344444', 'ngatrancofer@gmail.com', '0373434343'),
('8364046', 'hungvtvt01@gmail.com', '0362256850');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `study`
--

CREATE TABLE `study` (
  `student_id` varchar(7) NOT NULL,
  `course_id` varchar(7) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Đang đổ dữ liệu cho bảng `study`
--

INSERT INTO `study` (`student_id`, `course_id`) VALUES
('1112222', '1112223'),
('1112223', '1124455'),
('1112233', '1124990'),
('1122334', '1112345'),
('1223456', '1122337'),
('1233456', '1122447'),
('1234455', '1234455'),
('1234556', '1122447'),
('1234566', '1122356'),
('1234567', '1238899'),
('1235555', '1112345'),
('1236666', '1238899'),
('1237777', '1234455'),
('1238888', '1122337'),
('1239999', '1112345'),
('1239999', '1122447'),
('1239999', '1238899'),
('2341111', '1122356'),
('2342222', '1122356'),
('2343333', '1124455'),
('2344444', '1124455'),
('2345555', '1124990'),
('2346666', '1124990'),
('2347777', '1112223'),
('2348888', '1112345'),
('2349999', '1238899'),
('3341111', '1112223'),
('3342222', '1112345'),
('3343333', '1234455'),
('3344444', '1122337'),
('3345555', '1238899'),
('8364046', '1112223');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `supervisor`
--

CREATE TABLE `supervisor` (
  `student_id` varchar(7) NOT NULL,
  `email` varchar(255) NOT NULL,
  `phone` varchar(255) NOT NULL,
  `relationship` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Đang đổ dữ liệu cho bảng `supervisor`
--

INSERT INTO `supervisor` (`student_id`, `email`, `phone`, `relationship`) VALUES
('1234556', 'thanhphamdaughter@gmail.com', '0378466107', 'Cha'),
('2342222', 'trongvanbui@gmail.com', '0977457671', 'Cha'),
('2343333', 'luongsonvan03@gmail.com', '0344979797', 'Cha'),
('2346666', 'yenha@gmail.com', '0999774911', 'Mẹ'),
('3341111', 'thuongtruc@gmail.com', '0388889999', 'Mẹ'),
('3342222', 'huongho07@gmail.com', '0377741231', 'Chị'),
('3345555', 'nhannguyen57@gmail.com', '0957575757', 'Anh');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `teach`
--

CREATE TABLE `teach` (
  `teacher_id` varchar(7) NOT NULL,
  `course_id` varchar(7) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Đang đổ dữ liệu cho bảng `teach`
--

INSERT INTO `teach` (`teacher_id`, `course_id`) VALUES
('5511211', '1112223'),
('5511211', '1122447'),
('5522222', '1112345'),
('5522222', '1122356'),
('5533233', '1124455'),
('5533233', '1238899'),
('5544244', '1124990'),
('5544244', '1234455'),
('5555255', '1122337');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `teacher`
--

CREATE TABLE `teacher` (
  `teacher_id` varchar(7) NOT NULL,
  `type` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Đang đổ dữ liệu cho bảng `teacher`
--

INSERT INTO `teacher` (`teacher_id`, `type`) VALUES
('5511211', 'Bản xứ'),
('5522222', 'Bản xứ'),
('5533233', 'Ngoại quốc'),
('5544244', 'Ngoại quốc'),
('5555255', 'Bản xứ');

--
-- Chỉ mục cho các bảng đã đổ
--

--
-- Chỉ mục cho bảng `accept`
--
ALTER TABLE `accept`
  ADD PRIMARY KEY (`time`,`course_id`,`student_id`,`customer_serice_id`),
  ADD KEY `customer_serice_id` (`customer_serice_id`);

--
-- Chỉ mục cho bảng `at`
--
ALTER TABLE `at`
  ADD PRIMARY KEY (`num`,`branch_id`,`course_id`),
  ADD KEY `course_id` (`course_id`);

--
-- Chỉ mục cho bảng `branch`
--
ALTER TABLE `branch`
  ADD PRIMARY KEY (`branch_id`),
  ADD KEY `manager_id` (`manager_id`);

--
-- Chỉ mục cho bảng `classroom`
--
ALTER TABLE `classroom`
  ADD PRIMARY KEY (`num`,`branch_id`),
  ADD KEY `branch_id` (`branch_id`);

--
-- Chỉ mục cho bảng `course`
--
ALTER TABLE `course`
  ADD PRIMARY KEY (`course_id`),
  ADD KEY `manager_id` (`manager_id`);

--
-- Chỉ mục cho bảng `customer_serice`
--
ALTER TABLE `customer_serice`
  ADD PRIMARY KEY (`customer_serice_id`);

--
-- Chỉ mục cho bảng `manager`
--
ALTER TABLE `manager`
  ADD PRIMARY KEY (`manager_id`);

--
-- Chỉ mục cho bảng `request`
--
ALTER TABLE `request`
  ADD PRIMARY KEY (`time`,`course_id`,`student_id`),
  ADD KEY `course_id` (`course_id`),
  ADD KEY `student_id` (`student_id`);

--
-- Chỉ mục cho bảng `result`
--
ALTER TABLE `result`
  ADD PRIMARY KEY (`student_id`,`course_id`,`score`),
  ADD KEY `course_id` (`course_id`);

--
-- Chỉ mục cho bảng `review`
--
ALTER TABLE `review`
  ADD PRIMARY KEY (`student_id`,`course_id`),
  ADD KEY `course_id` (`course_id`);

--
-- Chỉ mục cho bảng `schedule`
--
ALTER TABLE `schedule`
  ADD PRIMARY KEY (`course_id`,`class_date`);

--
-- Chỉ mục cho bảng `staff`
--
ALTER TABLE `staff`
  ADD PRIMARY KEY (`staff_id`),
  ADD UNIQUE KEY `phone` (`phone`),
  ADD UNIQUE KEY `email` (`email`),
  ADD KEY `branch_id` (`branch_id`);

--
-- Chỉ mục cho bảng `student`
--
ALTER TABLE `student`
  ADD PRIMARY KEY (`student_id`);

--
-- Chỉ mục cho bảng `studentt18`
--
ALTER TABLE `studentt18`
  ADD PRIMARY KEY (`student_id`),
  ADD UNIQUE KEY `phone` (`phone`);

--
-- Chỉ mục cho bảng `study`
--
ALTER TABLE `study`
  ADD PRIMARY KEY (`student_id`,`course_id`),
  ADD KEY `course_id` (`course_id`);

--
-- Chỉ mục cho bảng `supervisor`
--
ALTER TABLE `supervisor`
  ADD PRIMARY KEY (`student_id`);

--
-- Chỉ mục cho bảng `teach`
--
ALTER TABLE `teach`
  ADD PRIMARY KEY (`teacher_id`,`course_id`),
  ADD KEY `course_id` (`course_id`);

--
-- Chỉ mục cho bảng `teacher`
--
ALTER TABLE `teacher`
  ADD PRIMARY KEY (`teacher_id`);

--
-- Các ràng buộc cho các bảng đã đổ
--

--
-- Các ràng buộc cho bảng `accept`
--
ALTER TABLE `accept`
  ADD CONSTRAINT `accept_ibfk_1` FOREIGN KEY (`time`,`course_id`,`student_id`) REFERENCES `request` (`time`, `course_id`, `student_id`),
  ADD CONSTRAINT `accept_ibfk_2` FOREIGN KEY (`customer_serice_id`) REFERENCES `customer_serice` (`customer_serice_id`);

--
-- Các ràng buộc cho bảng `at`
--
ALTER TABLE `at`
  ADD CONSTRAINT `at_ibfk_1` FOREIGN KEY (`num`,`branch_id`) REFERENCES `classroom` (`num`, `branch_id`),
  ADD CONSTRAINT `at_ibfk_2` FOREIGN KEY (`course_id`) REFERENCES `course` (`course_id`);

--
-- Các ràng buộc cho bảng `branch`
--
ALTER TABLE `branch`
  ADD CONSTRAINT `branch_ibfk_1` FOREIGN KEY (`manager_id`) REFERENCES `manager` (`manager_id`);

--
-- Các ràng buộc cho bảng `classroom`
--
ALTER TABLE `classroom`
  ADD CONSTRAINT `classroom_ibfk_1` FOREIGN KEY (`branch_id`) REFERENCES `branch` (`branch_id`);

--
-- Các ràng buộc cho bảng `course`
--
ALTER TABLE `course`
  ADD CONSTRAINT `course_ibfk_1` FOREIGN KEY (`manager_id`) REFERENCES `manager` (`manager_id`);

--
-- Các ràng buộc cho bảng `customer_serice`
--
ALTER TABLE `customer_serice`
  ADD CONSTRAINT `customer_serice_ibfk_1` FOREIGN KEY (`customer_serice_id`) REFERENCES `staff` (`staff_id`);

--
-- Các ràng buộc cho bảng `manager`
--
ALTER TABLE `manager`
  ADD CONSTRAINT `manager_ibfk_1` FOREIGN KEY (`manager_id`) REFERENCES `staff` (`staff_id`);

--
-- Các ràng buộc cho bảng `request`
--
ALTER TABLE `request`
  ADD CONSTRAINT `request_ibfk_1` FOREIGN KEY (`course_id`) REFERENCES `course` (`course_id`),
  ADD CONSTRAINT `request_ibfk_2` FOREIGN KEY (`student_id`) REFERENCES `student` (`student_id`);

--
-- Các ràng buộc cho bảng `result`
--
ALTER TABLE `result`
  ADD CONSTRAINT `result_ibfk_1` FOREIGN KEY (`student_id`) REFERENCES `student` (`student_id`),
  ADD CONSTRAINT `result_ibfk_2` FOREIGN KEY (`course_id`) REFERENCES `course` (`course_id`);

--
-- Các ràng buộc cho bảng `review`
--
ALTER TABLE `review`
  ADD CONSTRAINT `review_ibfk_1` FOREIGN KEY (`student_id`) REFERENCES `student` (`student_id`),
  ADD CONSTRAINT `review_ibfk_2` FOREIGN KEY (`course_id`) REFERENCES `course` (`course_id`);

--
-- Các ràng buộc cho bảng `schedule`
--
ALTER TABLE `schedule`
  ADD CONSTRAINT `schedule_ibfk_1` FOREIGN KEY (`course_id`) REFERENCES `course` (`course_id`);

--
-- Các ràng buộc cho bảng `staff`
--
ALTER TABLE `staff`
  ADD CONSTRAINT `staff_ibfk_1` FOREIGN KEY (`branch_id`) REFERENCES `branch` (`branch_id`);

--
-- Các ràng buộc cho bảng `studentt18`
--
ALTER TABLE `studentt18`
  ADD CONSTRAINT `studentt18_ibfk_1` FOREIGN KEY (`student_id`) REFERENCES `student` (`student_id`);

--
-- Các ràng buộc cho bảng `study`
--
ALTER TABLE `study`
  ADD CONSTRAINT `study_ibfk_1` FOREIGN KEY (`student_id`) REFERENCES `student` (`student_id`),
  ADD CONSTRAINT `study_ibfk_2` FOREIGN KEY (`course_id`) REFERENCES `course` (`course_id`);

--
-- Các ràng buộc cho bảng `supervisor`
--
ALTER TABLE `supervisor`
  ADD CONSTRAINT `supervisor_ibfk_1` FOREIGN KEY (`student_id`) REFERENCES `student` (`student_id`);

--
-- Các ràng buộc cho bảng `teach`
--
ALTER TABLE `teach`
  ADD CONSTRAINT `teach_ibfk_1` FOREIGN KEY (`teacher_id`) REFERENCES `teacher` (`teacher_id`),
  ADD CONSTRAINT `teach_ibfk_2` FOREIGN KEY (`course_id`) REFERENCES `course` (`course_id`);

--
-- Các ràng buộc cho bảng `teacher`
--
ALTER TABLE `teacher`
  ADD CONSTRAINT `teacher_ibfk_1` FOREIGN KEY (`teacher_id`) REFERENCES `staff` (`staff_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

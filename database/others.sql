-- FUNCTIONS
-- Trả về kết quả học viên đăng nhập
DELIMITER $$
CREATE FUNCTION CheckStudentLogin(studentID CHAR(7))
RETURNS INT
DETERMINISTIC
READS SQL DATA
BEGIN
    DECLARE res INT DEFAULT 0;
    SET res=(SELECT * FROM student WHERE student_id = studentID);
    RETURN res;
END $$
DELIMITER ;

-- Trả về kết quả nhân viên đăng nhập
DELIMITER $$
CREATE FUNCTION CheckStaffLogin(username CHAR(20), pwd CHAR(20))
RETURNS INT
DETERMINISTIC
READS SQL DATA
BEGIN
    DECLARE res INT DEFAULT 0;
    SET res=(SELECT * FROM user_management WHERE user = username AND password = pwd);
    RETURN res;
END $$
DELIMITER ;

-- Trả về loại nhân viên từ username
DELIMITER $$
CREATE FUNCTION GetStaffType(username CHAR(20))
RETURNS CHAR(50)
DETERMINISTIC
READS SQL DATA
BEGIN
    DECLARE res CHAR(50);
    SET res=(SELECT type FROM user_management WHERE user = username);
    RETURN res;
END $$
DELIMITER ;

-- Kiểm tra sinh viên có học một khóa học nào đó không
DELIMITER $$
CREATE FUNCTION CheckStudy(studentID CHAR(7), courseID CHAR(7))
RETURNS INT
DETERMINISTIC
READS SQL DATA
BEGIN
    DECLARE res INT DEFAULT 0;
    SET res=(SELECT * FROM study WHERE student_id = studentID  AND course_id = courseID);
    RETURN res;
END $$
DELIMITER ;

-- Kiểm tra khóa học đã kết thúc chưa
DELIMITER $$
CREATE FUNCTION CheckCourseDone(courseID CHAR(7))
RETURNS INT
DETERMINISTIC
READS SQL DATA
BEGIN
    DECLARE res INT DEFAULT 0;
    SET res=(SELECT * FROM course WHERE course_id = courseID AND status = "Done");
    RETURN res;
END $$
DELIMITER ;

-- Trả về số đánh giá khóa học của sinh viên
DELIMITER $$
CREATE FUNCTION CheckStudentReview(studentID CHAR(7), courseID CHAR(7))
RETURNS INT
DETERMINISTIC
READS SQL DATA
BEGIN
    DECLARE res INT DEFAULT 0;
    SET res=(SELECT * FROM review WHERE student_id = studentID  AND course_id = courseID);
    RETURN res;
END $$
DELIMITER ;

-- Trả về số yêu cầu chưa chấp thuận với một khóa học của học viên
DELIMITER $$
CREATE FUNCTION CheckStudentRequest(studentID CHAR(7), courseID CHAR(7))
RETURNS INT
DETERMINISTIC
READS SQL DATA
BEGIN
    DECLARE res INT DEFAULT 0;
    SET res=(SELECT * FROM request WHERE student_id = studentID AND course_id = courseID AND status = 0);
    RETURN res;
END $$
DELIMITER ;



-- PROCEDURES
-- Thêm đánh giá học viên với khóa học
DELIMITER $$
CREATE PROCEDURE AddReview(studentID CHAR(7), courseID CHAR(7), new_content CHAR(100))
BEGIN
    INSERT INTO review(student_id, course_id, content) VALUES(studentID, courseID, new_content);
END $$
DELIMITER ;

-- Sửa đánh giá học viên với khóa học
DELIMITER $$
CREATE PROCEDURE ChangeReview(studentID CHAR(7), courseID CHAR(7), new_content CHAR(100))
BEGIN
    UPDATE review SET content = new_content WHERE student_id = studentID AND course_id = courseID;
END $$
DELIMITER ;

-- Xóa đánh giá học viên với khóa học
DELIMITER $$
CREATE PROCEDURE ChangeReview(studentID CHAR(7), courseID CHAR(7), new_content CHAR(100))
BEGIN
    DELETE FROM review WHERE student_id = studentID AND course_id = courseID;
END $$
DELIMITER ;

-- Trả về các khóa học và đánh giá tương ứng của một học viên
DELIMITER $$
CREATE PROCEDURE GetCourse(studentID CHAR(7))
BEGIN
    SELECT review.content, review.time , course.name , course.course_id
    FROM review, course
    WHERE review.course_id = course.course_id AND review.student_id = studentID
END $$
DELIMITER ;

-- Thêm yêu cầu đăng kí/hủy với khóa học
DELIMITER $$
CREATE PROCEDURE AddAcceptRequest(studentID CHAR(7), courseID CHAR(7), kind CHAR(20))
BEGIN
    INSERT INTO accept(course_id, student_id, type) VALUES(courseID, studentID, kind);
END $$
DELIMITER ;

-- Thêm yêu cầu khác với khóa học
DELIMITER $$
CREATE PROCEDURE AddRequest(studentID CHAR(7), courseID CHAR(7), new_content CHAR(100))
BEGIN
    INSERT INTO request(student_id, course_id, content) VALUES(studentID, courseID, new_content);
END $$
DELIMITER ;

-- Xóa yêu cầu đăng kí/ hủy khóa học
DELIMITER $$
CREATE PROCEDURE DeleteAcceptRequest(studentID CHAR(7), courseID CHAR(7))
BEGIN
    DELETE FROM accept WHERE student_id=studentID AND course_id=courseID;
END $$
DELIMITER ;

-- Xóa yêu cầu khác với một khóa học
DELIMITER $$
CREATE PROCEDURE DeleteRequest(studentID CHAR(7), courseID CHAR(7))
BEGIN
    DELETE FROM request WHERE student_id=studentID AND course_id=courseID AND status = 0;
END $$
DELIMITER ;

-- Sửa yêu cầu khác với một khóa học
DELIMITER $$
CREATE PROCEDURE ChangeRequest(studentID CHAR(7), courseID CHAR(7), new_content CHAR(100))
BEGIN
    UPDATE request SET content = new_content WHERE student_id = studentID AND course_id = courseID AND status = 0;
END $$
DELIMITER ;

-- Trả về yêu cầu khác về khóa học của một học viên
DELIMITER $$
CREATE PROCEDURE GetRequest(studentID CHAR(7))
BEGIN
    SELECT request.content, request.status , request.time , course.name AS course_name, course.course_id
    FROM request, course
    WHERE request.course_id = course.course_id AND request.student_id = studentID;
END $$
DELIMITER ;

-- Trả về yêu cầu đăng kí/ hủy khóa học của một học viên
DELIMITER $$
CREATE PROCEDURE GetAcceptRequest(studentID CHAR(7))
BEGIN
    SELECT *, accept.time AS reg_time FROM accept, course WHERE accept.course_id = course.course_id AND accept.student_id = studentID;
END $$
DELIMITER ;



-- TRIGGERS
--  



-- ASSERTIONS
-- Các phòng chứa tối đa là số dương bé hơn 100
CREATE ASSERTION CheckRoomCap
AS CHECK (NO EXTISTS (SELECT * FROM classroom WHERE capacity > 100 OR capacity < 0));
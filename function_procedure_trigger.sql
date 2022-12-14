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

-- Tính tuổi học viên
DELIMITER $$
CREATE FUNCTION CalcStudentAge(studentID CHAR(20))
RETURNS INT
DETERMINISTIC
READS SQL DATA
BEGIN
    DECLARE res INT;
    SET res=(CURDATE() - (SELECT dob FROM student WHERE student_id = studentID))/10000;
    RETURN res;
END $$
DELIMITER ;

-- Tính tuổi nhân viên
DELIMITER $$
CREATE FUNCTION CalcStaffAge(staffID CHAR(20))
RETURNS INT
DETERMINISTIC
READS SQL DATA
BEGIN
    DECLARE res INT;
    SET res=(CURDATE() - (SELECT dob FROM staff WHERE staff_id = staffID))/10000;
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

--Bổ sung:
-- Trả về thông tin kết quả các khóa học (Tên,ID khóa học, tên giáo viên, điểm kết quả và nhận xét của giáo viên)
DELIMITER $$
CREATE FUNCTION GetCourseofStudent(studentID CHAR(7))
RETURNS INT
DETERMINISTIC
READS SQL DATA
BEGIN
    DECLARE res INT DEFAULT 0;
    SET res=(SELECT result.score,result.comment, course.course_id , course.name AS course_name, staff.name AS teacher_name
                                          FROM (result INNER JOIN course ON result.course_id = course.course_id)
                                          INNER JOIN (
                                            teach INNER JOIN staff ON teach.teacher_id = staff.staff_id
                                          ) ON teach.course_id = result.course_id AND result.student_id = studentID);
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
CREATE PROCEDURE DeleteReview(studentID CHAR(7), courseID CHAR(7))
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

-- Chấp nhận yêu cầu khác về khoá học của một học viên
DELIMITER $$
CREATE PROCEDURE AcceptRequest(studentID CHAR(7), courseID CHAR(7))
BEGIN
    UPDATE request SET request.status = 1 WHERE student_id = studentID AND course_id= courseID AND status = 0;
END $$
DELIMITER ;

<<<<<<< HEAD:database/function_procedure_trigger.sql
-- Trả về toàn bộ thông tin của nhân viên quản lý chi nhánh
DELIMITER $$
CREATE PROCEDURE GetBranchManagerInfor()
BEGIN
    SELECT *, staff.address AS address, branch.address AS branch_address FROM manager, staff, branch
    WHERE staff.staff_id = manager.manager_id 
    AND manager.dept = 'Quản lý chi nhánh' 
    AND branch.manager_id = manager.manager_id;
END $$
DELIMITER ;


-- Trả về toàn bộ thông tin của nhân viên quản lý khóa học
DELIMITER $$
CREATE PROCEDURE GetCourseManagerInfor()
BEGIN
    SELECT * FROM manager, staff 
    WHERE staff.staff_id = manager.manager_id 
    AND manager.dept = 'Quản lý khoá học';
END $$
DELIMITER ;


-- Trả về toàn bộ thông tin đánh giá khóa học của học viên
DELIMITER $$
CREATE PROCEDURE GetAllReview()
BEGIN
SELECT review.time, review.content, course.name AS course_name, course.course_id, student.name AS student_name, student.student_id
FROM (review INNER JOIN course ON review.course_id = course.course_id)
INNER JOIN student ON review.student_id = student.student_id;
END $$
DELIMITER ;

-- Trả về toàn bộ thông tin đánh giá học viên theo khóa học của giáo viên
DELIMITER $$
CREATE PROCEDURE GetAllResult()
BEGIN
    SELECT result.score, result.comment , course.name as course_name , course.course_id, student.name as student_name, student.student_id
    FROM (result INNER JOIN  course ON result.course_id = course.course_id)
    INNER JOIN student ON student.student_id = result.student_id;
END $$
DELIMITER ;




-- Trả về toàn bộ thông tin của nhân viên đánh giá khách hàng
DELIMITER $$
CREATE PROCEDURE GetAllCSKHInfor()
BEGIN
    SELECT * FROM customer_serice, staff 
    WHERE customer_serice.customer_serice_id = staff.staff_id;
END $$
DELIMITER ;

-- Trả về toàn bộ thông tin của giáo viên
DELIMITER $$
CREATE PROCEDURE GetAllTeacherInfor()
BEGIN
    SELECT * FROM teacher, staff 
    WHERE teacher.teacher_id = staff.staff_id;
END $$
DELIMITER ;


-- Trả về toàn bộ yêu cầu khác về khóa học của học viên
DELIMITER $$
CREATE PROCEDURE GetAllOtherRequest()
BEGIN
    SELECT request.time, request.content, request.status , student.name as student_name, course.name as course_name
    FROM (request INNER JOIN course ON request.course_id = course.course_id)
    INNER JOIN student ON student.student_id = request.student_id
END $$
DELIMITER ;

-- Trả về toàn bộ yêu cầu khác về khóa học của học viên theo trạng thái
DELIMITER $$
CREATE PROCEDURE GetAllOtherRequestFilter(statusIn CHAR(7))
BEGIN
    SELECT request.time, request.content, request.status , student.name as student_name, course.name as course_name
    FROM (request INNER JOIN course ON request.course_id = course.course_id)
    INNER JOIN student ON student.student_id = request.student_id
    WHERE request.status = statusIn;
END $$
DELIMITER ;


=======
-- Xoá đánh giá khoá học của sinh viên
DELIMITER $$
CREATE PROCEDURE AcceptRequest(studentID CHAR(7), courseID CHAR(7))
BEGIN
    UPDATE request SET request.status = 1 WHERE student_id = studentID AND course_id= courseID AND status = 0;
END $$
DELIMITER ;
-- Xoá kết quả khoá học của học viên
DELIMITER $$
CREATE PROCEDURE DeleteResult(studentID CHAR(7), courseID CHAR(7))
BEGIN
    DELETE FROM result WHERE student_id = studentID AND course_id= courseID;
END $$
DELIMITER ;
>>>>>>> e66b3521381166afa3dd17bbcd0d7b577099c57e:database/others.sql

-- TRIGGERS
-- Tự động sửa sức chứa của phòng học cho hợp lệ
DELIMITER $$
CREATE TRIGGER UpdateRoomCap
BEFORE INSERT ON classroom
FOR EACH ROW
BEGIN
    IF NEW.capacity < 0 THEN
        SET NEW.capacity = 0;
    ELSEIF NEW.capacity > 100 THEN
        SET NEW.capacity = 100;
    END IF;
END $$
DELIMITER ;

-- Request trong bảng accept phải thuộc dạng đăng kí hoặc hủy khóa học
DELIMITER $$
CREATE TRIGGER CheckAcceptType
BEFORE INSERT ON accept
FOR EACH ROW
BEGIN
    IF not exists (SELECT * FROM accept WHERE type ='IN' OR type ='OUT') THEN
        SIGNAL SQLSTATE '45000'
        SET MESSAGE_TEXT = 'Invalid type!';
    END IF;
END $$
DELIMITER ;


-- Trạng thái khóa học phải hoàn tất hoặc trong tiến trình
DELIMITER $$
CREATE TRIGGER CheckCourseStatus
BEFORE INSERT ON accept
FOR EACH ROW
BEGIN
    IF exists (SELECT * FROM course WHERE status NOT IN ('In progress', 'Done')) THEN
        SIGNAL SQLSTATE '45000'
        SET MESSAGE_TEXT = 'Invalid status!';
    END IF;
END $$
DELIMITER ;


-- Trạng thái của yêu cầu khác phải thuộc được chấp nhận hoặc không
DELIMITER $$
CREATE TRIGGER CheckRequestStatus
BEFORE INSERT ON accept
FOR EACH ROW
BEGIN
    IF exists (SELECT * FROM request WHERE status NOT IN (0, 1)) THEN
        SIGNAL SQLSTATE '45000'
        SET MESSAGE_TEXT = 'Invalid request status!';
    END IF;
END $$
DELIMITER ;
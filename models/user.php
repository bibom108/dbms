<?php
require_once('connection.php');
class User
{
    public $name;
    public $age;
    public $address;
    public $dob;
    public $student_id;

    public function __construct($student_id, $name, $address, $dob, $age){
    
        $this->name = $name;
        $this->age = $age;
        $this->student_id = $student_id;
        $this->address = $address;
        $this->dob = $dob;
    }

    static function getAll()
    {
        $db = DB::getInstance();
        $req = $db->query(
            "SELECT *
            FROM student;"
        );
        $users = [];
        foreach($req->fetch_all(MYSQLI_ASSOC) as $user) {
            $users[] = new User(
                $user['student_id'],
                $user['name'],
                $user['address'],
                $user['dob'],
                $user['age']
            );
        }
        return $users;
    }

    static function get($student_id)
    {
        $db = DB::getInstance();
        $req = $db->query(
            "
            SELECT *
            FROM student
            WHERE student_id = '$student_id'
            ;"
        );
        $result = $req->fetch_assoc();
        $user = new User(
            $result['student_id'],
            $result['name'],
            $result['address'],
            $result['dob'],
            $result['age']
        );
        return $user;
    }

    static function insert($email, $profile_photo, $fname, $lname, $gender, $age, $phone, $password)
    {
        //hàm này là để tạo nick hay gì đó á

        // $password = password_hash($password, PASSWORD_DEFAULT);
        // $db = DB::getInstance();
        // $req = $db->query(
        //     "
        //     INSERT INTO user (email, profile_photo, fname, lname, gender, age, phone, createAt, updateAt, password)
        //     VALUES ('$email', '$profile_photo', '$fname', '$lname', $gender, $age, '$phone', NOW(), NOW(), '$password')
        //     ;");
        // return $req;
    }

    static function delete($student_id)
    {
        // $db = DB::getInstance();
        // $req = $db->query("DELETE FROM student WHERE student_id = '$student_id';");
        // return $req;
    }

    static function update($name, $dob, $address, $age)
    {
        //Cái này là cập nhật thông tin nè
        $db = DB::getInstance();
    }

    static function validation($student_id, $password)
    {
        $db = DB::getInstance();
        if(empty($student_id)){
            $error['username'] = 'Bạn chưa nhập tên tài khoản';
        }
        if(empty($password)){
            $error['pwd'] = 'Bạn chưa nhập password';
        }
        $res = $db->query("SELECT * FROM student WHERE student_id = '$student_id'");
        if ($res->num_rows > 0) {
            return true;
        }
        else return false;
        //hàm này là đăng nhập nè Phúc
    }

}

?>
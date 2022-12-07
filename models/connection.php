<?php
class DB
{
    public static $instance = NULL;
    public static $student = NULL, $teacher = NULL, $stdcare = NULL,$bra_mng = NULL;
    public static function getInstance() 
    {
        if (!isset(self::$instance)) 
        {
            self::$instance = mysqli_connect("localhost", "db-admin", "", "db_assignment");

            if (mysqli_connect_errno())
            {
                die("Failed to connect to MySQL: " . mysqli_connect_error());
            }
        }

        return self::$instance;
    }
    public static function getInstanceforStudent() 
    {
        if (!isset(self::$student)) 
        {
            self::$student = mysqli_connect("localhost",'db-student','',"db_assignment");
            if (mysqli_connect_errno())
            {
                die("Failed to connect to MySQL: " . mysqli_connect_error());
            }
        }
        return self::$student;
    }
    public static function getInstanceforTeacher() 
    {
        if (!isset(self::$teacher)) 
        {
            self::$teacher = mysqli_connect("localhost",'db-teacher','',"db_assignment");
            if (mysqli_connect_errno())
            {
                die("Failed to connect to MySQL: " . mysqli_connect_error());
            }
        }
        return self::$teacher;
    }
    public static function getInstanceforCustomerserice() 
    {
        if (!isset(self::$stdcare)) 
        {
            self::$stdcare = mysqli_connect("localhost",'db-customerserice','',"db_assignment");
            if (mysqli_connect_errno())
            {
                die("Failed to connect to MySQL: " . mysqli_connect_error());
            }
        }
        return self::$stdcare;
    }
    public static function getInstanceforManage() 
    {
        if (!isset(self::$bra_mng)) 
        {
            self::$bra_mng = mysqli_connect("localhost",'db-manager','',"db_assignment");
            if (mysqli_connect_errno())
            {
                die("Failed to connect to MySQL: " . mysqli_connect_error());
            }
        }
        return self::$bra_mng;
    }
}

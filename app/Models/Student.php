<?php
namespace App\Models;

class Student 
{
    private $id;
    private $name;
    private $age;
    private $major;
    private $email;
    
    /**
     * Constructor - Khởi tạo đối tượng sinh viên
     */
    public function __construct($name = "Nguyễn Văn A", $age = 20, $major = "Công nghệ thông tin")
    {
        $this->id = rand(1000, 9999); // Tạo ID ngẫu nhiên
        $this->name = $name;
        $this->age = $age;
        $this->major = $major;
        $this->email = $this->generateEmail();
    }
    
    /**
     * Tạo email từ tên sinh viên
     */
    private function generateEmail()
    {
        // Chuyển tên thành chữ thường, bỏ dấu
        $name = strtolower($this->name);
        $name = str_replace(' ', '.', $name);
        return $name . '@student.edu.vn';
    }
    
    /**
     * Lấy thông tin đầy đủ của sinh viên
     */
    public function getInfo() 
    {
        return "Sinh viên: {$this->name}, {$this->age} tuổi, Ngành: {$this->major}";
    }
    
    /**
     * Lấy thông tin chi tiết dạng HTML
     */
    public function getDetailedInfo()
    {
        return "
            <strong>Mã SV:</strong> {$this->id}<br>
            <strong>Họ tên:</strong> {$this->name}<br>
            <strong>Tuổi:</strong> {$this->age}<br>
            <strong>Ngành:</strong> {$this->major}<br>
            <strong>Email:</strong> {$this->email}
        ";
    }
    
    // Getter methods
    public function getName() 
    {
        return $this->name;
    }
    
    public function getAge()
    {
        return $this->age;
    }
    
    public function getMajor()
    {
        return $this->major;
    }
    
    public function getId()
    {
        return $this->id;
    }
    
    public function getEmail()
    {
        return $this->email;
    }
    
    // Setter methods
    public function setName($name)
    {
        $this->name = $name;
        $this->email = $this->generateEmail(); // Cập nhật lại email
    }
    
    public function setAge($age)
    {
        $this->age = $age;
    }
    
    public function setMajor($major)
    {
        $this->major = $major;
    }
}
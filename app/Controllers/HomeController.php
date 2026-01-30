<?php
namespace App\Controllers;

use App\Models\Student;

class HomeController 
{
    /**
     * Hiển thị trang chủ
     */
    public function index() 
    {
        // BƯỚC 1: Chuẩn bị dữ liệu
        $message = "Chào mừng đến với MVC Framework!";
        
        // BƯỚC 2: Lấy dữ liệu từ Model
        $student = new Student("Lê Văn Cường", 22, "Khoa học máy tính");
        $studentInfo = $student->getDetailedInfo();
        
        // BƯỚC 3: Gọi View và truyền dữ liệu
        // Lưu ý: Các biến $message và $studentInfo sẽ được sử dụng trong view
        include 'views/home.php';
    }
    
    /**
     * Trang giới thiệu (demo thêm)
     */
    public function about()
    {
        echo "<h1>Trang giới thiệu</h1>";
        echo "<p>Đây là ứng dụng MVC đơn giản</p>";
        echo '<a href="index.php?page=home">← Quay lại</a>';
    }
}
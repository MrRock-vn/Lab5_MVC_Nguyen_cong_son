<?php
namespace App\Models;

use PDO;
use PDOException;

/**
 * CLASS: BaseModel
 * MỤC ĐÍCH: Quản lý kết nối Database, các Model khác sẽ kế thừa class này
 */
class BaseModel 
{
    protected $conn; // Biến lưu kết nối PDO
    
    /**
     * Constructor - Tự động kết nối DB khi tạo đối tượng
     */
    public function __construct() 
    {
        $this->connect();
    }
    
    /**
     * Kết nối đến MySQL Database
     */
    private function connect() 
    {
        // Thông tin kết nối
        $host = 'localhost';
        $dbname = 'lab5_mvc';
        $username = 'root';
        $password = ''; // Để trống nếu dùng XAMPP mặc định
        
        try {
            // Tạo kết nối PDO
            $this->conn = new PDO(
                "mysql:host=$host;dbname=$dbname;charset=utf8mb4",
                $username,
                $password,
                [
                    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
                    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
                    PDO::ATTR_EMULATE_PREPARES => false
                ]
            );
            
        } catch (PDOException $e) {
            // Nếu kết nối thất bại, hiển thị lỗi
            die("
                <div style='background:#f8d7da; color:#721c24; padding:20px; border-radius:5px; margin:20px;'>
                    <h2>❌ Lỗi kết nối Database!</h2>
                    <p><strong>Thông báo:</strong> {$e->getMessage()}</p>
                    <hr>
                    <h3>Cách khắc phục:</h3>
                    <ol>
                        <li>Kiểm tra XAMPP đã start MySQL chưa</li>
                        <li>Kiểm tra tên database: <code>lab5_mvc</code></li>
                        <li>Kiểm tra username/password trong BaseModel.php</li>
                    </ol>
                </div>
            ");
        }
    }
    
    /**
     * Destructor - Đóng kết nối khi đối tượng bị hủy
     */
    public function __destruct() 
    {
        $this->conn = null;
    }
}
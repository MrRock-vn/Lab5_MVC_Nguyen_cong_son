<?php
namespace App\Models;

use PDO;
use PDOException;

/**
 * CLASS: BaseModel
 * MỤC ĐÍCH: Quản lý kết nối Database chung cho tất cả Model
 */
class BaseModel 
{
    protected $pdo; // Thuộc tính PDO - các Model con sẽ kế thừa
    protected $table; // Tên bảng - Model con sẽ định nghĩa
    
    /**
     * Constructor - Tự động kết nối DB
     */
    public function __construct() 
    {
        $this->connect();
    }
    
    /**
     * Kết nối Database
     */
    private function connect() 
    {
        $host = 'localhost';
        $dbname = 'lab5_mvc';
        $username = 'root';
        $password = '';
        
        try {
            $this->pdo = new PDO(
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
            die("
                <div style='background:#f8d7da; color:#721c24; padding:20px; border-radius:5px; margin:20px; font-family:Arial;'>
                    <h2>❌ Lỗi kết nối Database!</h2>
                    <p><strong>Chi tiết:</strong> {$e->getMessage()}</p>
                    <hr>
                    <h3>Cách khắc phục:</h3>
                    <ol>
                        <li>Bật MySQL trong XAMPP Control Panel</li>
                        <li>Kiểm tra tên database: <code>lab5_mvc</code></li>
                        <li>Kiểm tra username/password trong BaseModel.php</li>
                    </ol>
                </div>
            ");
        }
    }
    
    /**
     * Hàm helper: Lấy tất cả bản ghi
     */
    public function all()
    {
        $sql = "SELECT * FROM {$this->table} ORDER BY id DESC";
        $stmt = $this->pdo->query($sql);
        return $stmt->fetchAll();
    }
    
    /**
     * Hàm helper: Lấy 1 bản ghi theo ID
     */
    public function find($id)
    {
        $sql = "SELECT * FROM {$this->table} WHERE id = ?";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([$id]);
        return $stmt->fetch();
    }
    
    /**
     * Destructor - Đóng kết nối
     */
    public function __destruct() 
    {
        $this->pdo = null;
    }
}
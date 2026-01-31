<?php
namespace App\Models;

use PDO;

/**
 * CLASS: Product
 * MỤC ĐÍCH: Xử lý tất cả nghiệp vụ liên quan đến sản phẩm
 */
class Product extends BaseModel 
{
    protected $table = 'products'; // Tên bảng trong database
    
    /**
     * Lấy tất cả sản phẩm
     * @return array
     */
    public function all() 
    {
        $sql = "SELECT * FROM {$this->table} ORDER BY created_at DESC";
        $stmt = $this->pdo->query($sql);
        return $stmt->fetchAll();
    }
    
    /**
     * Lấy sản phẩm theo ID
     * @param int $id
     * @return array|false
     */
    public function find($id) 
    {
        $sql = "SELECT * FROM {$this->table} WHERE id = ?";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([$id]);
        return $stmt->fetch();
    }
    
    /**
     * Xóa sản phẩm theo ID
     * @param int $id
     * @return bool
     */
    public function delete($id)
    {
        $sql = "DELETE FROM {$this->table} WHERE id = ?";
        $stmt = $this->pdo->prepare($sql);
        return $stmt->execute([$id]);
    }
    
    /**
     * Thêm sản phẩm mới
     * @param array $data
     * @return bool
     */
    public function insert($data)
    {
        $sql = "INSERT INTO {$this->table} (name, price, description, category, stock, image) 
                VALUES (:name, :price, :description, :category, :stock, :image)";
        
        $stmt = $this->pdo->prepare($sql);
        return $stmt->execute([
            ':name' => $data['name'],
            ':price' => $data['price'],
            ':description' => $data['description'],
            ':category' => $data['category'] ?? 'Other',
            ':stock' => $data['stock'] ?? 0,
            ':image' => $data['image'] ?? 'default.jpg'
        ]);
    }
    
    /**
     * Cập nhật sản phẩm
     * @param int $id
     * @param array $data
     * @return bool
     */
    public function update($id, $data)
    {
        $sql = "UPDATE {$this->table} 
                SET name = :name, 
                    price = :price, 
                    description = :description,
                    category = :category,
                    stock = :stock,
                    image = :image
                WHERE id = :id";
        
        $stmt = $this->pdo->prepare($sql);
        return $stmt->execute([
            ':id' => $id,
            ':name' => $data['name'],
            ':price' => $data['price'],
            ':description' => $data['description'],
            ':category' => $data['category'],
            ':stock' => $data['stock'],
            ':image' => $data['image']
        ]);
    }
    
    /**
     * Đếm tổng số sản phẩm
     * @return int
     */
    public function count()
    {
        $sql = "SELECT COUNT(*) as total FROM {$this->table}";
        $stmt = $this->pdo->query($sql);
        return $stmt->fetch()['total'];
    }
    
    /**
     * Tìm kiếm sản phẩm theo tên
     * @param string $keyword
     * @return array
     */
    public function search($keyword)
    {
        $sql = "SELECT * FROM {$this->table} 
                WHERE name LIKE :keyword 
                OR description LIKE :keyword
                ORDER BY created_at DESC";
        
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([':keyword' => "%{$keyword}%"]);
        return $stmt->fetchAll();
    }
    
    /**
     * Lấy danh mục sản phẩm (không trùng)
     * @return array
     */
    public function getCategories()
    {
        $sql = "SELECT DISTINCT category FROM {$this->table} ORDER BY category";
        $stmt = $this->pdo->query($sql);
        return $stmt->fetchAll(PDO::FETCH_COLUMN);
    }
}
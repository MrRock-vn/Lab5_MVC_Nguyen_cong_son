<?php
namespace App\Models;

/**
 * CLASS: Product
 * MỤC ĐÍCH: Xử lý dữ liệu liên quan đến sản phẩm
 */
class Product extends BaseModel 
{
    /**
     * Lấy tất cả sản phẩm
     * @return array Mảng chứa danh sách sản phẩm
     */
    public function getAllProducts() 
    {
        $sql = "SELECT * FROM products ORDER BY created_at DESC";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll();
    }
    
    /**
     * Lấy sản phẩm theo ID
     * @param int $id ID của sản phẩm
     * @return array|false Thông tin sản phẩm hoặc false nếu không tìm thấy
     */
    public function getProductById($id) 
    {
        $sql = "SELECT * FROM products WHERE id = ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute([$id]);
        return $stmt->fetch();
    }
    
    /**
     * Đếm tổng số sản phẩm
     * @return int Số lượng sản phẩm
     */
    public function getTotalProducts() 
    {
        $sql = "SELECT COUNT(*) as total FROM products";
        $stmt = $this->conn->query($sql);
        return $stmt->fetch()['total'];
    }
    
    /**
     * Lấy sản phẩm theo danh mục
     * @param string $category Tên danh mục
     * @return array Mảng sản phẩm thuộc danh mục
     */
    public function getProductsByCategory($category)
    {
        $sql = "SELECT * FROM products WHERE category = ? ORDER BY name";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute([$category]);
        return $stmt->fetchAll();
    }
    
    /**
     * Tìm kiếm sản phẩm theo tên
     * @param string $keyword Từ khóa tìm kiếm
     * @return array Mảng sản phẩm khớp với từ khóa
     */
    public function searchProducts($keyword)
    {
        $sql = "SELECT * FROM products WHERE name LIKE ? OR description LIKE ?";
        $stmt = $this->conn->prepare($sql);
        $searchTerm = "%{$keyword}%";
        $stmt->execute([$searchTerm, $searchTerm]);
        return $stmt->fetchAll();
    }
    
    /**
     * Lấy danh sách các danh mục
     * @return array Mảng các danh mục duy nhất
     */
    public function getCategories()
    {
        $sql = "SELECT DISTINCT category FROM products ORDER BY category";
        $stmt = $this->conn->query($sql);
        return $stmt->fetchAll(PDO::FETCH_COLUMN);
    }
}
<?php
session_start();
$errors = $_SESSION['errors'] ?? [];
unset($_SESSION['errors']);
?>
<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Chỉnh sửa sản phẩm - <?php echo htmlspecialchars($product['name']); ?></title>
    
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.0/font/bootstrap-icons.css">
    
    <style>
        body {
            background: #f8f9fa;
        }
        .required {
            color: red;
        }
    </style>
</head>
<body>
    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-dark bg-primary">
        <div class="container">
            <a class="navbar-brand" href="index.php">
                <i class="bi bi-shop"></i> Quản lý Sản phẩm
            </a>
            <div class="navbar-nav ms-auto">
                <a class="nav-link" href="index.php?page=home">
                    <i class="bi bi-house"></i> Trang chủ
                </a>
                <a class="nav-link" href="index.php?page=product-list">
                    <i class="bi bi-list"></i> Danh sách
                </a>
            </div>
        </div>
    </nav>

    <div class="container mt-4">
        <!-- Breadcrumb -->
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="index.php">Trang chủ</a></li>
                <li class="breadcrumb-item"><a href="index.php?page=product-list">Sản phẩm</a></li>
                <li class="breadcrumb-item active">Chỉnh sửa</li>
            </ol>
        </nav>

        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card shadow-sm">
                    <div class="card-header bg-warning text-dark">
                        <h4 class="mb-0">
                            <i class="bi bi-pencil-square"></i> Chỉnh sửa sản phẩm #<?php echo $product['id']; ?>
                        </h4>
                    </div>
                    <div class="card-body">
                        <!-- Hiển thị lỗi -->
                        <?php if (!empty($errors)): ?>
                            <div class="alert alert-danger alert-dismissible fade show">
                                <strong><i class="bi bi-exclamation-triangle"></i> Có lỗi xảy ra:</strong>
                                <ul class="mb-0 mt-2">
                                    <?php foreach ($errors as $error): ?>
                                        <li><?php echo $error; ?></li>
                                    <?php endforeach; ?>
                                </ul>
                                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                            </div>
                        <?php endif; ?>

                        <!-- Form sửa sản phẩm -->
                        <form action="index.php?page=product-update" method="POST">
                            <!-- Hidden field: ID -->
                            <input type="hidden" name="id" value="<?php echo $product['id']; ?>">

                            <!-- Tên sản phẩm -->
                            <div class="mb-3">
                                <label for="name" class="form-label">
                                    Tên sản phẩm <span class="required">*</span>
                                </label>
                                <input type="text" 
                                       class="form-control" 
                                       id="name" 
                                       name="name" 
                                       value="<?php echo htmlspecialchars($product['name']); ?>"
                                       required>
                            </div>

                            <!-- Giá -->
                            <div class="mb-3">
                                <label for="price" class="form-label">
                                    Giá (VNĐ) <span class="required">*</span>
                                </label>
                                <input type="number" 
                                       class="form-control" 
                                       id="price" 
                                       name="price" 
                                       value="<?php echo $product['price']; ?>"
                                       min="0"
                                       required>
                            </div>

                            <!-- Danh mục -->
                            <div class="mb-3">
                                <label for="category" class="form-label">Danh mục</label>
                                <select class="form-select" id="category" name="category">
                                    <?php
                                    $allCategories = ['Laptop', 'Smartphone', 'Tablet', 'Audio', 'Wearable', 'TV', 'Gaming', 'Other'];
                                    foreach ($allCategories as $cat) {
                                        $selected = ($product['category'] == $cat) ? 'selected' : '';
                                        echo "<option value='$cat' $selected>$cat</option>";
                                    }
                                    ?>
                                </select>
                            </div>

                            <!-- Số lượng -->
                            <div class="mb-3">
                                <label for="stock" class="form-label">Số lượng tồn kho</label>
                                <input type="number" 
                                       class="form-control" 
                                       id="stock" 
                                       name="stock" 
                                       value="<?php echo $product['stock']; ?>"
                                       min="0">
                            </div>

                            <!-- Mô tả -->
                            <div class="mb-3">
                                <label for="description" class="form-label">Mô tả sản phẩm</label>
                                <textarea class="form-control" 
                                          id="description" 
                                          name="description" 
                                          rows="4"><?php echo htmlspecialchars($product['description']); ?></textarea>
                            </div>

                            <!-- Hình ảnh -->
                            <div class="mb-3">
                                <label for="image" class="form-label">Hình ảnh (URL hoặc tên file)</label>
                                <input type="text" 
                                       class="form-control" 
                                       id="image" 
                                       name="image" 
                                       value="<?php echo htmlspecialchars($product['image']); ?>">
                            </div>

                            <!-- Nút hành động -->
                            <div class="d-flex justify-content-between">
                                <a href="index.php?page=product-list" class="btn btn-secondary">
                                    <i class="bi bi-x-circle"></i> Hủy bỏ
                                </a>
                                <button type="submit" class="btn btn-warning">
                                    <i class="bi bi-check-circle"></i> Cập nhật sản phẩm
                                </button>
                            </div>
                        </form>
                    </div>
                </div>

                <!-- Thông tin thêm -->
                <div class="card mt-3 shadow-sm">
                    <div class="card-body">
                        <h6><i class="bi bi-info-circle"></i> Thông tin:</h6>
                        <ul class="mb-0">
                            <li>Ngày tạo: <strong><?php echo date('d/m/Y H:i', strtotime($product['created_at'])); ?></strong></li>
                            <li>Mã sản phẩm: <strong>#<?php echo $product['id']; ?></strong></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
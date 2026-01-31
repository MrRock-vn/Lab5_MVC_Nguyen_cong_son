<?php
// Lấy lỗi và dữ liệu cũ từ session (nếu có)
$errors = $_SESSION['errors'] ?? [];
$old = $_SESSION['old'] ?? [];
unset($_SESSION['errors'], $_SESSION['old']);
?>
<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Thêm sản phẩm mới</title>
    
    <!-- Bootstrap 5 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Bootstrap Icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.0/font/bootstrap-icons.css">
    
    <style>
        body {
            background: #f8f9fa;
        }
        .required {
            color: red;
        }
        .navbar {
            box-shadow: 0 2px 4px rgba(0,0,0,.1);
        }
        .card {
            border: none;
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
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item">
                        <a class="nav-link" href="index.php?page=home">
                            <i class="bi bi-house"></i> Trang chủ
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="index.php?page=product-list">
                            <i class="bi bi-list"></i> Danh sách
                        </a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <div class="container mt-4 mb-5">
        <!-- Breadcrumb -->
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="index.php?page=home">Trang chủ</a></li>
                <li class="breadcrumb-item"><a href="index.php?page=product-list">Sản phẩm</a></li>
                <li class="breadcrumb-item active">Thêm mới</li>
            </ol>
        </nav>

        <div class="row justify-content-center">
            <div class="col-md-8">
                <!-- Card Form -->
                <div class="card shadow-sm">
                    <div class="card-header bg-success text-white">
                        <h4 class="mb-0">
                            <i class="bi bi-plus-circle"></i> Thêm sản phẩm mới
                        </h4>
                    </div>
                    <div class="card-body p-4">
                        <!-- Hiển thị lỗi validation -->
                        <?php if (!empty($errors)): ?>
                            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                <h6 class="alert-heading">
                                    <i class="bi bi-exclamation-triangle"></i> Có lỗi xảy ra!
                                </h6>
                                <ul class="mb-0">
                                    <?php foreach ($errors as $error): ?>
                                        <li><?php echo htmlspecialchars($error); ?></li>
                                    <?php endforeach; ?>
                                </ul>
                                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                            </div>
                        <?php endif; ?>

                        <!-- Form thêm sản phẩm -->
                        <form action="index.php?page=product-store" method="POST">
                            
                            <!-- Tên sản phẩm -->
                            <div class="mb-3">
                                <label for="name" class="form-label fw-bold">
                                    <i class="bi bi-box"></i> Tên sản phẩm 
                                    <span class="required">*</span>
                                </label>
                                <input type="text" 
                                       class="form-control form-control-lg" 
                                       id="name" 
                                       name="name" 
                                       placeholder="Nhập tên sản phẩm (Ví dụ: iPhone 15 Pro Max)"
                                       value="<?php echo htmlspecialchars($old['name'] ?? ''); ?>"
                                       required>
                                <div class="form-text">Tên sản phẩm phải rõ ràng, dễ hiểu</div>
                            </div>

                            <!-- Giá -->
                            <div class="mb-3">
                                <label for="price" class="form-label fw-bold">
                                    <i class="bi bi-currency-dollar"></i> Giá sản phẩm (VNĐ)
                                    <span class="required">*</span>
                                </label>
                                <input type="number" 
                                       class="form-control form-control-lg" 
                                       id="price" 
                                       name="price" 
                                       placeholder="Nhập giá (Ví dụ: 30000000)"
                                       value="<?php echo htmlspecialchars($old['price'] ?? ''); ?>"
                                       min="1"
                                       step="1000"
                                       required>
                                <div class="form-text">Giá phải là số dương, lớn hơn 0</div>
                            </div>

                            <!-- Row: Danh mục + Tồn kho -->
                            <div class="row">
                                <!-- Danh mục -->
                                <div class="col-md-6 mb-3">
                                    <label for="category" class="form-label fw-bold">
                                        <i class="bi bi-tags"></i> Danh mục
                                    </label>
                                    <select class="form-select form-select-lg" id="category" name="category">
                                        <option value="Laptop" <?php echo ($old['category'] ?? 'Laptop') == 'Laptop' ? 'selected' : ''; ?>>
                                            💻 Laptop
                                        </option>
                                        <option value="Smartphone" <?php echo ($old['category'] ?? '') == 'Smartphone' ? 'selected' : ''; ?>>
                                            📱 Smartphone
                                        </option>
                                        <option value="Tablet" <?php echo ($old['category'] ?? '') == 'Tablet' ? 'selected' : ''; ?>>
                                            📱 Tablet
                                        </option>
                                        <option value="Audio" <?php echo ($old['category'] ?? '') == 'Audio' ? 'selected' : ''; ?>>
                                            🎧 Audio
                                        </option>
                                        <option value="Wearable" <?php echo ($old['category'] ?? '') == 'Wearable' ? 'selected' : ''; ?>>
                                            ⌚ Wearable
                                        </option>
                                        <option value="TV" <?php echo ($old['category'] ?? '') == 'TV' ? 'selected' : ''; ?>>
                                            📺 TV
                                        </option>
                                        <option value="Gaming" <?php echo ($old['category'] ?? '') == 'Gaming' ? 'selected' : ''; ?>>
                                            🎮 Gaming
                                        </option>
                                        <option value="Other" <?php echo ($old['category'] ?? '') == 'Other' ? 'selected' : ''; ?>>
                                            📦 Khác
                                        </option>
                                    </select>
                                </div>

                                <!-- Số lượng tồn kho -->
                                <div class="col-md-6 mb-3">
                                    <label for="stock" class="form-label fw-bold">
                                        <i class="bi bi-stack"></i> Số lượng tồn kho
                                    </label>
                                    <input type="number" 
                                           class="form-control form-control-lg" 
                                           id="stock" 
                                           name="stock" 
                                           placeholder="Số lượng"
                                           value="<?php echo htmlspecialchars($old['stock'] ?? '0'); ?>"
                                           min="0">
                                    <div class="form-text">Để 0 nếu hết hàng</div>
                                </div>
                            </div>

                            <!-- Mô tả -->
                            <div class="mb-3">
                                <label for="description" class="form-label fw-bold">
                                    <i class="bi bi-file-text"></i> Mô tả sản phẩm
                                </label>
                                <textarea class="form-control" 
                                          id="description" 
                                          name="description" 
                                          rows="5"
                                          placeholder="Nhập mô tả chi tiết về sản phẩm: tính năng, cấu hình, ưu điểm..."><?php echo htmlspecialchars($old['description'] ?? ''); ?></textarea>
                                <div class="form-text">Mô tả càng chi tiết càng tốt</div>
                            </div>

                            <!-- Hình ảnh -->
                            <div class="mb-4">
                                <label for="image" class="form-label fw-bold">
                                    <i class="bi bi-image"></i> Hình ảnh
                                </label>
                                <input type="text" 
                                       class="form-control" 
                                       id="image" 
                                       name="image" 
                                       placeholder="Nhập tên file hoặc URL (Ví dụ: product.jpg)"
                                       value="<?php echo htmlspecialchars($old['image'] ?? 'default.jpg'); ?>">
                                <div class="form-text">
                                    <i class="bi bi-info-circle"></i> 
                                    Có thể để trống, hệ thống sẽ dùng hình mặc định
                                </div>
                            </div>

                            <!-- Nút hành động -->
                            <div class="d-grid gap-2 d-md-flex justify-content-md-between">
                                <a href="index.php?page=product-list" class="btn btn-secondary btn-lg">
                                    <i class="bi bi-x-circle"></i> Hủy bỏ
                                </a>
                                <button type="submit" class="btn btn-success btn-lg px-5">
                                    <i class="bi bi-check-circle"></i> Thêm sản phẩm
                                </button>
                            </div>
                        </form>
                    </div>
                </div>

                <!-- Card hướng dẫn -->
                <div class="card shadow-sm mt-3">
                    <div class="card-body">
                        <h6 class="card-title">
                            <i class="bi bi-lightbulb text-warning"></i> 
                            <strong>Hướng dẫn sử dụng:</strong>
                        </h6>
                        <ul class="mb-0">
                            <li>Các trường có dấu <span class="required fw-bold">*</span> là <strong>bắt buộc</strong> phải nhập</li>
                            <li>Giá sản phẩm phải là số dương, lớn hơn 0 VNĐ</li>
                            <li>Chọn đúng danh mục để dễ quản lý</li>
                            <li>Mô tả chi tiết giúp khách hàng hiểu rõ sản phẩm hơn</li>
                            <li>Nếu không có hình ảnh, hệ thống sẽ dùng hình mặc định</li>
                        </ul>
                    </div>
                </div>

            </div>
        </div>
    </div>

    <!-- Bootstrap 5 JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
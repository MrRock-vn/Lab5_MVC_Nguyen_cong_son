<?php
// Load thư viện Composer
require 'vendor/autoload.php';

// Tạo đối tượng Faker tiếng Việt
$faker = Faker\Factory::create('vi_VN');

?>
<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <title>Bài 1: Faker Demo</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            max-width: 600px;
            margin: 50px auto;
            padding: 20px;
            background: #f5f5f5;
        }
        .card {
            background: white;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 2px 4px rgba(0,0,0,0.1);
        }
        h1 { 
            color: #333;
            text-align: center;
        }
        .info { 
            margin: 15px 0;
            padding: 10px;
            background: #f0f0f0;
            border-left: 4px solid #4CAF50;
        }
        .label { 
            font-weight: bold; 
            color: #555; 
        }
        .note {
            text-align: center;
            color: #888;
            margin-top: 20px;
        }
    </style>
</head>
<body>
    <div class="card">
        <h1>🎲 Dữ liệu ngẫu nhiên với Faker</h1>
        
        <div class="info">
            <span class="label">👤 Tên người:</span> 
            <?php echo $faker->name; ?>
        </div>
        
        <div class="info">
            <span class="label">📍 Địa chỉ:</span> 
            <?php echo $faker->address; ?>
        </div>
        
        <div class="info">
            <span class="label">📧 Email:</span> 
            <?php echo $faker->email; ?>
        </div>

        <div class="info">
            <span class="label">📱 Số điện thoại:</span> 
            <?php echo $faker->phoneNumber; ?>
        </div>
        
        <p class="note">
            <small>Nhấn F5 để tạo dữ liệu mới!</small>
        </p>
    </div>
</body>
</html>
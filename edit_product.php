<?php
session_start();
require("includes/common.php");

// Kiểm tra xem người dùng đã đăng nhập và có vai trò là admin chưa
if (!isset($_SESSION['email']) || $_SESSION['role'] != 'admin') {
    header('location: index.php'); // Chuyển hướng về trang chính nếu không phải admin
    exit();
}

// Xử lý form khi người dùng gửi dữ liệu
if ($_FILES['product_image']['name']) {
    $productImage = $_FILES['product_image']['name'];
    $targetDir = "images/";
    $targetFile = $targetDir . basename($productImage);
    move_uploaded_file($_FILES['product_image']['tmp_name'], $targetFile);
    
    // Cập nhật sản phẩm với hình ảnh mới
    $query = "UPDATE products SET name = '$productName', price = '$productPrice', image = '$productImage', brand = '$productBrand' WHERE id = '$productId'";
} else {
    // Cập nhật sản phẩm mà không thay đổi hình ảnh
    $query = "UPDATE products SET name = '$productName', price = '$productPrice', brand = '$productBrand' WHERE id = '$productId'";
}

mysqli_query($con, $query);
header('Location: admin_dashboard.php?success=Product updated successfully');
exit();
?>
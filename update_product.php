<?php
session_start();
require("includes/common.php");

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $productId = mysqli_real_escape_string($con, $_POST['product_id']);
    $productName = mysqli_real_escape_string($con, $_POST['product_name']);
    $productPrice = mysqli_real_escape_string($con, $_POST['product_price']);
    $productBrand = mysqli_real_escape_string($con, $_POST['product_brand']);
    $productDescription = mysqli_real_escape_string($con, $_POST['product_description']);


    // Kiểm tra xem có file hình ảnh mới nào được tải lên không
    if (!empty($_FILES['product_image']['name'])) {
        $productImage = $_FILES['product_image']['name'];
        $targetDir = "images/";
        $targetFile = $targetDir . basename($productImage);
        move_uploaded_file($_FILES['product_image']['tmp_name'], $targetFile);

        // Cập nhật sản phẩm với hình ảnh mới
        $query = "UPDATE products SET name='$productName', price='$productPrice', brand='$productBrand', image='$productImage', motasanpham='$productDescription' WHERE id='$productId'";
    } else {
        // Cập nhật sản phẩm mà không thay đổi hình ảnh
        $query = "UPDATE products SET name='$productName', price='$productPrice', brand='$productBrand', motasanpham='$productDescription' WHERE id='$productId'";
    }

    if (mysqli_query($con, $query)) {
        $_SESSION['message'] = "Cập nhật sản phẩm thành công!";
    } else {
        $_SESSION['message'] = "Chưa cập nhật được sản phẩm! " . mysqli_error($con);
    }

    // Chuyển hướng về trang quản lý sản phẩm
    header('Location: admin_dashboard.php?section=product');
    exit();
}
?>


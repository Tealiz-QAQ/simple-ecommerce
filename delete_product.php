<?php
session_start();
if (!isset($_SESSION['role']) || $_SESSION['role'] !== 'admin') {
    header('Location: index.php'); // Chuyển hướng nếu không phải admin
    exit();
}

// Kết nối đến cơ sở dữ liệu
require("includes/common.php");

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $product_id = $_POST['product_id'];

    // Xóa sản phẩm khỏi cơ sở dữ liệu
    $query = "DELETE FROM products WHERE id = ?";
    $stmt = mysqli_prepare($con, $query);
    mysqli_stmt_bind_param($stmt, 'i', $product_id);
    mysqli_stmt_execute($stmt);

    // Kiểm tra xem xóa có thành công không
    if (mysqli_stmt_affected_rows($stmt) > 0) {
        echo "Sản phẩm đã được xóa thành công.";
    } else {
        echo "Có lỗi xảy ra khi xóa sản phẩm.";
    }

    mysqli_stmt_close($stmt);
}


// Chuyển hướng về trang quản trị sản phẩm
header('Location: admin_dashboard.php');
exit();
?>

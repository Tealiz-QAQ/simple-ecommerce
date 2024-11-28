<?php
require("includes/common.php");
session_start();

if (isset($_GET['id']) && is_numeric($_GET['id'])) {
    $item_id = $_GET['id'];
    $user_id = $_SESSION['user_id'];

    // Kiểm tra xem sản phẩm đã có trong giỏ hàng chưa
    $check_query = "SELECT * FROM users_products WHERE user_id = '$user_id' AND item_id = '$item_id' AND status = 'Added to cart'";
    $result = mysqli_query($con, $check_query);

    if (mysqli_num_rows($result) > 0) {
        // Nếu sản phẩm đã có, cập nhật số lượng
        $row = mysqli_fetch_assoc($result);
        $new_quantity = $row['quantity'] + 1; // Tăng số lượng lên 1
        $update_query = "UPDATE users_products SET quantity = '$new_quantity' WHERE user_id = '$user_id' AND item_id = '$item_id'";
        mysqli_query($con, $update_query) or die(mysqli_error($con));
    } else {
        // Nếu sản phẩm chưa có, thêm mới với số lượng là 1
        $query = "INSERT INTO users_products(user_id, item_id, status, quantity) VALUES('$user_id', '$item_id', 'Added to cart', 1)";
        mysqli_query($con, $query) or die(mysqli_error($con));
    }

    header('location: cart.php');
}
?>

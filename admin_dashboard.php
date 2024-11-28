<?php
session_start();
if (!isset($_SESSION['role']) || $_SESSION['role'] !== 'admin') {
    header('Location: index.php');
    exit();
}

require("includes/common.php");

// Lấy danh sách người dùng
$query = "SELECT id, email_id, first_name, last_name FROM users";
$result = mysqli_query($con, $query);
$users = mysqli_fetch_all($result, MYSQLI_ASSOC);

// Xử lý tìm kiếm
$searchTerm = isset($_POST['searchTerm']) ? $_POST['searchTerm'] : '';
$searchField = isset($_POST['searchField']) ? $_POST['searchField'] : 'name';

// Số sản phẩm mỗi trang
$perPage = 8;

// Lấy trang hiện tại từ URL, mặc định là trang 1 nếu không có
$currentPage = isset($_GET['page']) ? (int)$_GET['page'] : 1;
$currentPage = max(1, $currentPage); // Đảm bảo trang hợp lệ

// Tính toán giá trị của $start (vị trí bắt đầu)
$start = ($currentPage - 1) * $perPage;

// Xây dựng câu truy vấn để lấy danh sách sản phẩm
$query_products = "SELECT id, name, price, brand, motasanpham, image FROM products ";
if ($searchTerm) {
    if ($searchField == 'name') {
        $query_products .= " WHERE name LIKE '%$searchTerm%'";
    } else if ($searchField == 'brand') {
        $query_products .= " WHERE brand LIKE '%$searchTerm%'";
    }
}

// Thêm LIMIT để phân trang
$query_products .= " LIMIT $start, $perPage";

// Thực thi truy vấn và lấy kết quả
$result_products = mysqli_query($con, $query_products);
$products = mysqli_fetch_all($result_products, MYSQLI_ASSOC);

// Thêm sản phẩm
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['product_name'])) {
    $productName = mysqli_real_escape_string($con, $_POST['product_name']);
    $productPrice = mysqli_real_escape_string($con, $_POST['product_price']);
    $productBrand = mysqli_real_escape_string($con, $_POST['product_brand']);
    $productDescription = mysqli_real_escape_string($con, $_POST['product_description']);
    $productImage = $_FILES['product_image']['name'];
    $targetDir = "images/";
    $targetFile = $targetDir . basename($productImage);
    move_uploaded_file($_FILES['product_image']['tmp_name'], $targetFile);
    $query = "INSERT INTO products (name, price, image, brand, motasanpham) VALUES ('$productName', '$productPrice', '$productImage', '$productBrand', '$productDescription')";
    mysqli_query($con, $query);
    header('location: admin_dashboard.php?success=Product added successfully');
    exit();
}

// Cập nhật sản phẩm
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['product_id'])) {
    $productId = mysqli_real_escape_string($con, $_POST['product_id']);
    $productName = mysqli_real_escape_string($con, $_POST['product_name']);
    $productPrice = mysqli_real_escape_string($con, $_POST['product_price']);
    $productBrand = mysqli_real_escape_string($con, $_POST['product_brand']);
    $productDescription = mysqli_real_escape_string($con, $_POST['product_description']);
    if ($_FILES['product_image']['name']) {
        $productImage = $_FILES['product_image']['name'];
        $targetDir = "images/";
        $targetFile = $targetDir . basename($productImage);
        move_uploaded_file($_FILES['product_image']['tmp_name'], $targetFile);
        $query = "UPDATE products SET name = '$productName', price = '$productPrice', image = '$productImage', brand = '$productBrand', motasanpham = '$productDescription' WHERE id = '$productId'";
    } else {
        $query = "UPDATE products SET name = '$productName', price = '$productPrice', brand = '$productBrand', motasanpham = '$productDescription' WHERE id = '$productId'";
    }
    mysqli_query($con, $query);
    header('Location: admin_dashboard.php?success=Product updated successfully');
    exit();
}

// Xử lý cập nhật quyền người dùng
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['user_id'])) {
    $userId = mysqli_real_escape_string($con, $_POST['user_id']);
    $userRole = mysqli_real_escape_string($con, $_POST['user_role']);

    $query = "UPDATE users SET role = '$userRole' WHERE id = '$userId'";
    mysqli_query($con, $query);
    header('Location: admin_dashboard.php?success=User role updated successfully');
    exit();
}
// Số sản phẩm mỗi trang
$perPage = 8;

// Lấy trang hiện tại từ URL, mặc định là trang 1 nếu không có
$page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
$start = ($page - 1) * $perPage;

// Lấy tổng số sản phẩm
$query_count = "SELECT COUNT(id) AS total FROM products";
$result_count = mysqli_query($con, $query_count);
$total_products = mysqli_fetch_assoc($result_count)['total'];

// Tính số trang
$totalPages = ceil($total_products / $perPage);

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
    <link rel="stylesheet" href="styles.css"> <!-- Thêm CSS nếu cần -->
    <link href='https://fonts.googleapis.com/css?family=Delius+Swash+Caps' rel='stylesheet'>
    <link href='https://fonts.googleapis.com/css?family=Andika' rel='stylesheet'>
    <style>
        section{
            display: none;
        }
        body {
            font-family: 'Andika', sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f4f4f4;
        }

        header {
            background: #35424a;
            color: #ffffff;
            padding: 20px 0;
            text-align: center;
        }

        header h1 {
            font-family: 'Delius Swash Caps', cursive; /* Áp dụng font cho tiêu đề */
            margin: 0;
        }

        nav {
            margin: 20px 0;
        }

        nav a {
            color: #ffffff;
            text-decoration: none;
            margin: 0 15px;
        }

        nav a:hover {
            text-decoration: underline;
        }

        main {
            padding: 20px;
        }

        section {
            margin-bottom: 40px;
            background: #ffffff;
            padding: 20px;
            border-radius: 5px;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
        }

        h2, input, button {
            font-family: 'Andika', sans-serif; /* Áp dụng font cho các tiêu đề h2 */
            color: #35424a;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }

        table th, table td {
            border: 2px solid #dddddd;
            text-align: right;
            padding: 8px;
        }

        #user-table th:nth-child(1){
            width: 5%;
        }

        #user-table th:nth-child(2){
            width: 30%;
        }

        #user-table th:nth-child(3){
            width: 20%;
        }

        #user-table th:nth-child(4){
            width: 10%;
        }

        #user-table th:nth-child(5){
            width: 8%;
        }
        #user-table th:nth-child(6){
            width: 5%;
        }
        #product-table th:nth-child(1){
            width: 4%;
        }
        #product-table th:nth-child(2){
            width: 40%;
        }
        #product-table th:nth-child(3){
            width: 15%;
        }
        #product-table th:nth-child(4){
            width: 10%;
        }
        #product-table th:nth-child(5){
            width: 30%;
        }

        #product-table th:nth-child(6){
            width: 1%;
        }


        table th {
            background-color: #35424a;
            color: #ffffff;
        }

        table tr:nth-child(even) {
            background-color: #f2f2f2;
        }

        table tr:hover {
            background-color: #eaeaea;
        }

        footer {
            text-align: center;
            padding: 10px 0;
            background: #35424a;
            color: #ffffff;
            position: relative;
            bottom: 0;
            width: 100%;
        }

        button {
            color: white;
            border: none;
            padding: 10px 15px;
            cursor: pointer;
            border-radius: 5px;
        }

        .m1{
            background-color: #35424a;
        }
        .m1:hover{
            background-color: #1d2429;
        }
        .btndelete {
            background-color: #F60002;
        }
        .btndelete:hover {
            background-color: #7f0304;
        }

        .btnadd, .btnedit {
            background-color: #28a745; /* Màu xanh cho nút thêm sản phẩm */
            margin: 10px 0;
        }

        .btnadd:hover, .btnedit:hover {
            background-color: #218838; /* Màu xanh đậm khi hover */
        }

        .popup {
            display: none; /* Ẩn popup mặc định */
            position: fixed;
            left: 0;
            top: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0, 0, 0, 0.5);
            justify-content: center;
            align-items: center;
        }

        .popup-content {
            background-color: #fff;
            padding: 20px;
            border-radius: 5px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
            width: 500px;
        }

        .close {
            cursor: pointer;
            color: #e74c3c;
            float: right;
            font-size: 20px;
        }

        .form-group {
            margin-bottom: 15px;
        }

        .form-control {
            width: 95%;
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 5px;
        }

        .form-control-file {
            border: 1px solid #ccc;
            border-radius: 5px;
            padding: 5px;
        }

        select{
            width: 95%;
            appearance: none;
            -webkit-appearance: none;
            -moz-appearance: none;
            background-color: #fff;
            border: 1px solid #ccc;
            border-radius: 4px;
            color: #333;
            font-size: 16px;
            padding: 8px 12px;
            width: 200px;
        }

        select:hover {
  border-color: #999;
}
.pagination {
    text-align: center;
    margin-top: 20px;
}

.pagination a {
    display: inline-block;
    margin: 0 5px;
    padding: 8px 12px;
    background-color: #35424a;
    color: white;
    text-decoration: none;
    border-radius: 4px;
}

.pagination a:hover {
    background-color: #1d2429;
}

.pagination a.active {
    background-color: #28a745;
}

.pagination a:disabled {
    background-color: #eaeaea;
    color: #ccc;
}


    </style>
</head>
<body>
    <header>
        <h1>Admin Dashboard</h1>
        <nav>
            <a href="logout_script.php">Đăng Xuất</a>
        </nav>
    </header>

    <main>
    <button class="m1" onclick="toggleSection('user')">Quản Lý Người Dùng</button>
    <button class= "m1" onclick="toggleSection('product')">Quản Lý Sản Phẩm</button>
        <section id="user">
            <h2>Quản Lý Người Dùng</h2>
            <table id="user-table">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Email</th>
                        <th>Tên người dùng</th>
                        <th>Vai trò hiện tại</th>
                        <th>Phân quyền người dùng</th>
                        <th>Hành động</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($users as $user): ?>
                    <tr>
                        <td><?php echo $user['id']; ?></td>
                        <td><?php echo $user['email_id']; ?></td>
                        <td><?php echo $user['last_name']," ";
                                    echo $user['first_name']; ?></td>
                        <td>
                            <?php
                                $query = "SELECT role FROM users WHERE id = {$user['id']}";
                                $result = mysqli_query($con, $query);
                                $currentRole = mysqli_fetch_assoc($result)['role'];
                                echo $currentRole;
                            ?>
                        </td>
                            <td>
                                <form method="POST" action="">
                                <select name="user_role" required>
                                    <option value="user">User</option>
                                    <option value="admin">Admin</option>
                                </select>
                                    <input type="hidden" name="user_id" value="<?php echo $user['id']; ?>">
                                    <td>
                                    <button type="submit" class="btnadd">Xác Nhận</button>
                                    </td>
                                </form>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>     
            </table>
        </section>
        <section id="product">
            <h2 style="display: inline-block; margin-right: 20px;">Quản Lý Sản Phẩm</h2>
            <button class="btnadd" onclick="showPopup()">Thêm Sản Phẩm</button> <br>
            <form method="POST" action="" style="display: inline-block;">
                <input type="text" name="searchTerm" placeholder="Tìm kiếm sản phẩm..." value="<?php echo $searchTerm; ?>" style="font-size: 15px;">
                <label><input type="radio" name="searchField" value="name" <?php echo $searchField === 'name' ? 'checked' : ''; ?>> Tên sản phẩm</label>
                <label><input type="radio" name="searchField" value="brand" <?php echo $searchField === 'brand' ? 'checked' : ''; ?>> Loại sản phẩm</label>
                <button class="btnadd" type="submit">Tìm kiếm</button>
            </form>
            <table id="product-table">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Tên Sản Phẩm</th>
                        <th>Giá</th>
                        <th>Loại sản phẩm</th>
                        <th>Mô tả sản phẩm</th>
                        <th>Hình ảnh</th>
                        <th>Hành động</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($products as $product): ?>
                        <tr>
                            <td><?php echo $product['id']; ?></td>
                            <td><?php echo $product['name']; ?></td>
                            <td><?php echo number_format($product['price']); ?> VND</td>
                            <td><?php echo $product['brand']; ?></td>
                            <td><?php echo $product['motasanpham']; ?></td>
                            <td> <img src="images/<?php echo $product['image']; ?>" alt="<?php echo $product['name']; ?>" style="width: 100px; height: 100px;"></td>
                            <td style="display: flex; gap: 8px; align-items: center;">
    <form action="delete_product.php" method="POST" onsubmit="return confirm('Bạn có chắc chắn muốn xóa sản phẩm này?');">
        <input type="hidden" name="product_id" value="<?php echo $product['id']; ?>">
        <button class="btndelete" type="submit">Xóa</button>
    </form>
    <button class="btnedit" onclick="showEditPopup('<?php echo $product['id']; ?>', '<?php echo addslashes($product['name']); ?>', '<?php echo $product['price']; ?>', '<?php echo addslashes($product['brand']); ?>', '<?php echo addslashes($product['motasanpham']); ?>')">
        Sửa
    </button>
</td>

                        </tr>
                    <?php endforeach; ?>
                </tbody>

            </table>
             <div class="pagination">
    <?php if ($page > 1): ?>
        <a href="?page=<?php echo $page - 1; ?>&section=product">Trang trước</a>
    <?php endif; ?>
    
    <?php for ($i = 1; $i <= $totalPages; $i++): ?>
        <a href="?page=<?php echo $i; ?>&section=product" <?php if ($i == $page) echo 'class="active"'; ?>><?php echo $i; ?></a>
    <?php endfor; ?>
    
    <?php if ($page < $totalPages): ?>
        <a href="?page=<?php echo $page + 1; ?>&section=product">Trang sau</a>
    <?php endif; ?>
</div>

        </section>

        <div class="popup" id="productPopup">
            <div class="popup-content">
                <span class="close" onclick="closePopup()">&times;</span>
                <h2>Thêm Sản Phẩm Mới</h2>
                <form method="POST" enctype="multipart/form-data">
                    <div class="form-group">
                        <label for="product_name">Tên Sản Phẩm:</label>
                        <input type="text" class="form-control" id="product_name" name="product_name" required>
                    </div>
                    <div class="form-group">
                        <label for="product_price">Giá:</label>
                        <input type="number" class="form-control" id="product_price" name="product_price" required>
                    </div>
                    <div class="form-group">
                        <label for="product_brand">Loại sản phẩm:</label>
                        <input type="text" class="form-control" id="product_brand" name="product_brand" required>
                    </div>
                    <div class="form-group">
                        <label for="product_description">Mô tả sản phẩm:</label>
                        <input type="text" class="form-control" id="product_description" name="product_description" required>
                    </div>
                    <div class="form-group">
                        <label for="product_image">Hình Ảnh:</label>
                        <input type="file" class="form-control-file" id="product_image" name="product_image" required>
                    </div>
                    <button class="btnadd" type="submit">Thêm Sản Phẩm</button>
                </form>
            </div>
        </div>
        <!-- Popup sửa sản phẩm -->
        <div class="popup" id="editProductPopup">
            <div class="popup-content">
                <span class="close" onclick="closeEditPopup()">&times;</span>
                <h2>Sửa Sản Phẩm</h2>
                <form method="POST" enctype="multipart/form-data" action="update_product.php">
                    <input type="hidden" id="edit_product_id" name="product_id">
                    <div class="form-group">
                        <label for="edit_product_name">Tên Sản Phẩm:</label>
                        <input type="text" class="form-control" id="edit_product_name" name="product_name" required>
                    </div>
                    <div class="form-group">
                        <label for="edit_product_price">Giá:</label>
                        <input type="number" class="form-control" id="edit_product_price" name="product_price" required>
                    </div>
                    <div class="form-group">
                        <label for="edit_product_brand">Loại sản phẩm:</label>
                        <input type="text" class="form-control" id="edit_product_brand" name="product_brand" required>
                    </div>
                    <div class="form-group">
                        <label for="edit_product_description">Mô tả sản phẩm:</label>
                        <textarea class="form-control" id="edit_product_description" name="product_description" required></textarea>
                    </div>
                    <div class="form-group">
                        <label for="edit_product_image">Hình Ảnh (nếu muốn thay đổi):</label>
                        <input type="file" class="form-control-file" id="edit_product_image" name="product_image">
                    </div>
                    <button class="btnedit" type="submit">Cập Nhật Sản Phẩm</button>
                </form>
            </div>
        </div>
    </main>
    <footer>
        <p>Bản quyền © 2024</p>
    </footer>

    <script>
        function showPopup() {
            document.getElementById('productPopup').style.display = 'flex';
        }

        function closePopup() {
            document.getElementById('productPopup').style.display = 'none';
        }

        function showEditPopup(productId, productName, productPrice, productBrand, productDescription) {
            document.getElementById('edit_product_id').value = productId;
            document.getElementById('edit_product_name').value = productName;
            document.getElementById('edit_product_price').value = productPrice;
            document.getElementById('edit_product_brand').value = productBrand;
            document.getElementById('edit_product_description').value = productDescription;
            document.getElementById('editProductPopup').style.display = 'flex';
        }

        function closeEditPopup() {
            document.getElementById('editProductPopup').style.display = 'none';
        }

        function searchProduct() {
            // Implement search functionality here
        }

        // Show a popup if there’s a session message
        <?php if (isset($_SESSION['message'])): ?>
            alert('<?php echo $_SESSION['message']; ?>');
            <?php unset($_SESSION['message']); ?>
        <?php endif; ?>

        /// Hàm để chuyển đổi giữa các section
function toggleSection(sectionId) {
    var sections = document.querySelectorAll('section');
    sections.forEach(function(section) {
        section.style.display = 'none'; // Ẩn tất cả các section
    });

    // Hiển thị section đang được chọn
    document.getElementById(sectionId).style.display = 'block';

    // Lưu trạng thái section vào localStorage để nhớ khi tải lại trang
    localStorage.setItem('activeSection', sectionId);
}

// Lấy trạng thái section đã lưu từ localStorage khi trang tải lại
window.onload = function() {
    var activeSection = localStorage.getItem('activeSection');
    if (activeSection) {
        toggleSection(activeSection);
    } else {
        // Mặc định sẽ hiển thị 'product' nếu không có section nào được lưu
        toggleSection('product');
    }
};


        
    </script>
</body>
</html>

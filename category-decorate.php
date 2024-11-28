<?php
session_start();
require("includes/common.php"); // Kết nối cơ sở dữ liệu

// Lấy danh sách sản phẩm từ cơ sở dữ liệu
$category = isset($_GET['category']) ? $_GET['category'] : '';
$query = "SELECT DISTINCT brand, id, name, price, image, motasanpham FROM products WHERE brand = 'trangtri'" . ($category ? " AND category = '$category'" : ""); // Thêm motasanpham vào truy vấn
$result = mysqli_query($con, $query);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Baker's Mart | Online Shopping</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css">
    <link href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet">
    <link href='https://fonts.googleapis.com/css?family=Delius Swash Caps' rel='stylesheet'>
    <link href='https://fonts.googleapis.com/css?family=Andika' rel='stylesheet'>
    <link rel="stylesheet" href="style.css">
    <style>
        /* Thêm CSS tùy chỉnh ở đây nếu cần */
        .product-image {
            height: 200px; /* Thay đổi chiều cao theo ý muốn */
            object-fit: cover; /* Đảm bảo ảnh không bị biến dạng */
            width: 100%; /* Đảm bảo ảnh chiếm toàn bộ chiều rộng của thẻ cha */
        }
        /* Đặt kích thước cho modal */
        .modal-dialog {
            max-width: 350px; /* Kích thước chiều rộng */
        }

        /* Đặt kích thước cho hình ảnh trong modal */
        #modalProductImage {
            width: 300px; /* Kích thước chiều rộng */
            height: 190px; /* Kích thước chiều cao */
            object-fit: cover; /* Đảm bảo hình ảnh không bị biến dạng */
        }
    </style>
</head>
<body>
<!--header -->
<?php
include 'includes/header_menu.php';
include 'includes/check-if-added.php';
?>
<!--header ends -->
<div class="container" style="margin-top:65px">
    <!--jumbotron start-->
    <div class="jumbotron text-center">
        <h1>Chào mừng đến Baker's Mart!</h1>
        <p>Chúng tôi có tất cả dụng cụ làm bánh cho bạn</p>
    </div>
    <!--jumbotron ends-->
    
    <!--breadcrumb start-->
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="index.php">Home</a></li>
            <li class="breadcrumb-item"><a href="products.php">Sản phẩm</a></li>
            <li class="breadcrumb-item active" aria-current="page">Trang trí</li>
        </ol>
    </nav>
    <!--breadcrumb end-->
    
    <hr/>
    
    <!--menu list-->
    <div class="row text-center" id="products">
    <?php while ($row = mysqli_fetch_assoc($result)) { ?>
        <div class="col-md-3 col-6 py-2">
            <div class="card">
                <img src="images/<?php echo $row['image']; ?>" alt="" class="img-fluid product-image pb-1" 
                    data-toggle="modal" 
                    data-target="#productModal" 
                    data-name="<?php echo $row['name']; ?>" 
                    data-price="<?php echo number_format($row['price'], 0, ',', '.'); ?>₫" 
                    data-description="<?php echo $row['motasanpham']; ?>" 
                    data-image="images/<?php echo $row['image']; ?>"> 

                <div class="figure-caption">
                    <h6><?php echo $row['name']; ?></h6>
                    <h6>Giá: <?php echo number_format($row['price'], 0, ',', '.'); ?>₫</h6>
                    <?php if (!isset($_SESSION['email'])) { ?>
                        <p><a href="index.php#login" role="button" class="btn btn-warning text-white">Thêm vào giỏ hàng</a></p>
                    <?php } else {
                        if (check_if_added_to_cart($row['id'])) {
                            echo '<p><a href="#" class="btn btn-warning text-white" disabled>Added to cart</a></p>';
                        } else { ?>
                            <p><a href="cart-add.php?id=<?php echo $row['id']; ?>" class="btn btn-warning text-white">Thêm vào giỏ hàng</a></p>
                        <?php }
                    } ?>
                </div>
            </div>
        </div>
    <?php } ?>
</div>
    <!--menu list ends-->

    <!-- Modal -->
    <div class="modal fade" id="productModal" tabindex="-1" role="dialog" aria-labelledby="productModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modalProductName"></h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <img id="modalProductImage" src="" alt="" class="img-fluid mb-3">
                    <p><strong>Mô tả:</strong></p>
                    <p id="modalProductDescription"></p>
                    <p id="modalProductPrice"></p>
                    <div class="text-center">
                        <button id="addToCartButton" class="btn btn-primary">Thêm vào giỏ hàng</button>
                    </div>
                </div>
            </div>
        </div>
    </div>

</div>
 <!-- footer-->
 <?php include 'includes/footer.php' ?>
    <!--footer ends-->
</body>
<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js"></script>
<script>
$(document).ready(function(){
    $('#productModal').on('show.bs.modal', function (event) {
        var button = $(event.relatedTarget); // nút kích hoạt modal
        var name = button.data('name');
        var price = button.data('price');
        var description = button.data('description');
        var image = button.data('image');

        var modal = $(this);
        modal.find('#modalProductName').text(name);
        modal.find('#modalProductPrice').text(price);
        modal.find('#modalProductDescription').text(description);
        modal.find('#modalProductImage').attr('src', image);
    });
});
// JavaScript để điều khiển modal và nút Thêm vào giỏ hàng
document.addEventListener('DOMContentLoaded', function () {
    // Lấy tất cả các ảnh sản phẩm
    const productImages = document.querySelectorAll('.product-image');

    // Lấy các thành phần trong modal
    const modalProductName = document.getElementById('modalProductName');
    const modalProductImage = document.getElementById('modalProductImage');
    const modalProductDescription = document.getElementById('modalProductDescription');
    const modalProductPrice = document.getElementById('modalProductPrice');
    const addToCartButton = document.getElementById('addToCartButton');

    // Xử lý khi nhấn vào ảnh sản phẩm
    productImages.forEach(img => {
        img.addEventListener('click', function () {
            const name = this.dataset.name;
            const image = this.dataset.image;
            const description = this.dataset.description;
            const price = this.dataset.price;
            const productId = this.dataset.id; // Bổ sung data-id cho ảnh

            // Gán giá trị vào modal
            modalProductName.textContent = name;
            modalProductImage.src = image;
            modalProductDescription.textContent = description;
            modalProductPrice.textContent = `Giá: ${price}`;

            // Cập nhật hành động của nút "Thêm vào giỏ hàng"
            const isLoggedIn = <?php echo isset($_SESSION['email']) ? 'true' : 'false'; ?>;
            const isAdded = <?php echo isset($_SESSION['cart']) && isset($_SESSION['cart'][$row['id']]) ? 'true' : 'false'; ?>;

            if (isLoggedIn) {
                if (isAdded) {
                    addToCartButton.disabled = true;
                    addToCartButton.textContent = 'Đã thêm vào giỏ hàng';
                    addToCartButton.classList.add('btn-secondary');
                } else {
                    addToCartButton.disabled = false;
                    addToCartButton.textContent = 'Thêm vào giỏ hàng';
                    addToCartButton.classList.remove('btn-secondary');
                    addToCartButton.onclick = function () {
                        window.location.href = `cart-add.php?id=${productId}`;
                    };
                }
            } else {
                addToCartButton.textContent = 'Đăng nhập để thêm vào giỏ hàng';
                addToCartButton.disabled = false;
                addToCartButton.onclick = function () {
                    window.location.href = 'index.php#login';
                };
            }
        });
    });
});

</script>
</html>

<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Baker's Mart | Online Shopping</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css">
    <link href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet" >
    <link href='https://fonts.googleapis.com/css?family=Delius Swash Caps' rel='stylesheet'>
    <link href='https://fonts.googleapis.com/css?family=Andika' rel='stylesheet'>
    <link rel="stylesheet" href="path/to/your/bootstrap.css">
    <link rel="stylesheet" href="path/to/your/styles.css">
    <link rel="stylesheet" href="style.css">
    <!--css thanh cuộn-->
    <style>
        .category-image {
            height: 200px; /* Thay đổi chiều cao theo ý muốn */
            object-fit: cover; /* Đảm bảo ảnh không bị biến dạng */
            width: 100%; /* Đảm bảo ảnh chiếm toàn bộ chiều rộng của thẻ cha */
            border-radius: 0.5rem; /* Giữ border-radius như ban đầu */
        }

    </style>
</head>
<body style="margin-bottom:200px">
    <!--Header-->
    <?php
include 'includes/header_menu.php';
include 'includes/check-if-added.php';
?>
    <!--Header ends-->
    <div id="content">
    <div id="bg" style="background-image: url('images/webpage.jpg'); background-size: cover; background-position: center; padding-top: 150px;">
        <div class="container">
            <div class="mx-auto p-5 text-white" id="banner_content" style="border-radius: 0.5rem; background: rgba(0, 0, 0, 0.5);">
                <h1>We sell Happiness :)</h1>
                <p>###</p>
                <a href="products.php" class="btn btn-warning btn-lg text-white">Shop Now</a>
            </div>
        </div>
    </div>
</div>


    <div class="text-center pt-4 h3">
        Baker's Mart
    </div>
    <!--menu highlights start-->
    <div class="container pt-3">
        <div class="row text-center">
            <div class="col-6 col-md-3 py-3">
                <a href="category-material.php"> 
                    <img src="images/botlambanh.jpg" class="img-fluid category-image" alt="">
                    <div class="h5 pt-3 font-weight-bolder">
                        Nguyên liệu
                    </div>
                </a>
            </div>
            <div class="col-6 col-md-3 py-3">
                <a href="category-tool.php">
                    <img src="images/sf400.jpg" class="img-fluid category-image" alt="">
                    <div class="h5 pt-3 font-weight-bolder">
                        Dụng cụ
                    </div>
                </a>
            </div>
            <div class="col-6 col-md-3 py-3">
                <a href="category-decorate.php">
                    <img src="images/phukien1.jpg" class="img-fluid category-image" alt="">
                    <div class="h5 pt-3 font-weight-bolder">
                        Phụ kiện trang trí
                    </div>
                </a>
            </div>
            <div class="col-6 col-md-3 py-3">
                <a href="category-ingredients.php">
                    <img src="images/cadong.jpg" class="img-fluid category-image" alt="">
                    <div class="h5 pt-3 font-weight-bolder">
                        Pha chế
                    </div>
                </a>
            </div>
        </div>
    </div>
    <!--menu highlights end-->
    <!--footer -->
    <?php include 'includes/footer.php'?>
    <!--footer end-->




</body>
<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js"></script>
<script>
$(document).ready(function(){
  $('[data-toggle="popover"]').popover();
});
$(document).ready(function() {

if(window.location.href.indexOf('#login') != -1) {
  $('#login').modal('show');
}

});
</script>
<?php if (isset($_GET['error'])) {$z = $_GET['error'];
    echo "<script type='text/javascript'>
$(document).ready(function(){
$('#signup').modal('show');
});
</script>";
    echo "<script type='text/javascript'>alert('" . $z . "')</script>";}?>
    
<?php if (isset($_GET['errorl'])) {$z = $_GET['errorl'];
    echo "<script type='text/javascript'>
$(document).ready(function(){
$('#login').modal('show');
});
</script>";
    echo "<script type='text/javascript'>alert('" . $z . "')</script>";}?>
</html>


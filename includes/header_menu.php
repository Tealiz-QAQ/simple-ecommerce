<!--Navigation bar start-->
<nav class="navbar fixed-top navbar-expand-sm navbar-dark" id="navbar" style="background-color:rgba(0,0,0,0.5)">
    <div class="container">
        <a href="index.php" class="navbar-brand" style="font-family: 'Delius Swash Caps'">Baker's Mart</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#mynavbar">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="mynavbar">
            <ul class="nav navbar-nav">
                <li class="nav-item dropdown">
                    <a href="" class="nav-link dropdown-toggle" id="navbar-drop" data-toggle="dropdown">
                        Sản phẩm
                    </a>
                    <div class="dropdown-menu" id="myDropdown">
                        <a href="category-material.php" class="dropdown-item">Nguyên liệu làm bánh</a>
                        <a href="category-decorate.php" class="dropdown-item">Trang trí</a>
                        <a href="category-ingredients.php" class="dropdown-item">Pha chế</a>
                        <a href="category-tool.php" class="dropdown-item">Dụng cụ</a>
                    </div>
                </li>
                <li class="nav-item"><a href="about.php" class="nav-link">About us</a></li>
                <?php if (isset($_SESSION['email'])) { ?>
                    <li class="nav-item"><a href="cart.php" class="nav-link">Giỏ hàng</a></li>
                <?php } ?>
            </ul>

            <?php if (isset($_SESSION['email'])) { ?>
                <ul class="nav navbar-nav ml-auto">
                    <li class="nav-item"><a href="logout_script.php" class="nav-link"><i class="fa fa-sign-out"></i>Đăng xuất</a></li>
                    <li class="nav-item"><a class="nav-link" data-placement="bottom" data-toggle="popover" data-trigger="hover" data-content="<?php echo $_SESSION['email'] ?>"><i class="fa fa-user-circle"></i></a></li>
                </ul>
            <?php } else { ?>
                <ul class="nav navbar-nav ml-auto">
                    <li class="nav-item"><a href="#signup" class="nav-link" data-toggle="modal"><i class="fa fa-user"></i> Đăng ký</a></li>
                    <li class="nav-item"><a href="#login" class="nav-link" data-toggle="modal"><i class="fa fa-sign-in"></i> Đăng nhập</a></li>
                </ul>
            <?php } ?>
        </div>
    </div>
</nav>
<!--navigation bar end-->

    <!--Login trigger Modal-->
    <div class="modal fade" id="login" >
        <div class="modal-dialog modal-dialog-centered" role="document">
          <div class="modal-content"style="background-color:rgba(255,255,255,0.95)">

            <div class="modal-header">
              <h5 class="modal-title">Đăng nhập</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>

            <div class="modal-body">
              <form action="login_script.php" method="post">
                 <div class="form-group">
                     <label for="email">Địa chỉ email:</label>
                     <input type="email" class="form-control"  name="lemail" placeholder="Enter email" required>
                </div>
                <div class="form-group">
                    <label for="pwd">Password:</label>
                    <input type="password" class="form-control" id="pwd"  name="lpassword" placeholder="Password" required>
                </div>
                <div class="form-check">
                    <input type="checkbox" class="form-check-input">
                    <label for="checkbox" class="form-check-label">Check me out</label>
                </div>
                <button type="submit" class="btn btn-secondary btn-block" name="Submit">Đăng nhập</button>
              </form>
              <a href="http://">Quên mật khẩu ?</a>
            </div>
            <div class="modal-footer">
              <p class="mr-auto">Bạn chưa đăng ký? <a href="#signup" data-toggle="modal" data-dismiss="modal" >Đăng ký</a></p>
              <button type="button" class="btn btn-secondary" data-dismiss="modal" >Đóng</button>
            </div>
          </div>
        </div>
      </div>
    <!--Login trigger Model ends-->
    <!--Signup model start-->
    <div class="modal fade" id="signup">
        <div class="modal-dialog modal-dialog-centered" role="document">
          <div class="modal-content" style="background-color:rgba(255,255,255,0.95)">

            <div class="modal-header">
              <h5 class="modal-title">Đăng ký</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>

            <div class="modal-body">
              <form action="signup_script.php" method="post">
                <div class="form-group">
                     <label for="email">Địa chỉ Email:</label>
                     <input type="email" class="form-control"  name="eMail" placeholder="Enter email" required>
                     <?php if(isset($_GET['error'])){ echo "<span class='text-danger'>".$_GET['error']."</span>" ;}  ?>
                </div>
                <div class="form-group">
                    <label for="pwd">Password:</label>
                    <input type="password" class="form-control" id="pwd" name="password" placeholder="Password" required>
                </div>

                <div class="form-row">
                    <div class="form-group col-md-6">
                        <label for="validation1">Họ</label>
                        <input type="text" class="form-control" id="validation1" name="firstName" placeholder="First Name" required>
                    </div>
                    <div class="form-group col-md -6">
                        <label for="validation2">Tên</label>
                        <input type="text" class="form-control" id="validation2" name="lastName" placeholder="Last Name">
                    </div>
                </div>
                
                <div class="form-check">
                    <input type="checkbox" class="form-check-input" required>
                    <label for="checkbox" class="form-check-label">Đồng ý điều khoản và điều kiện</label>
                </div>
                <button type="submit" class="btn btn-primary btn-block" name="Submit">Đăng ký</button>
              </form>
            </div>
            <div class="modal-footer">
              <p class="mr-auto">Đã có tài khoản?<a href="#login"  data-toggle="modal" data-dismiss="modal">Đăng nhập</a></p>
              <button type="button" class="btn btn-secondary" data-dismiss="modal" >Đóng</button>
            </div>
          </div>
        </div>
      </div>
      <!--Signup trigger model ends-->
      



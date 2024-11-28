<?php
require ("includes/common.php");
session_start();
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>Baker's Mart | Online Shopping</title>
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css">
  <link href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet">
  <link href='https://fonts.googleapis.com/css?family=Delius Swash Caps' rel='stylesheet'>
  <link href='https://fonts.googleapis.com/css?family=Andika' rel='stylesheet'>
  <link rel="stylesheet" href="style.css">
</head>
<body style="overflow-x:hidden; padding-bottom:100px;">
  <?php
        include 'includes/header_menu.php';
    ?>
  <div>
    <div class="container mt-5 ">
      <div class="row justify-content-around">
        <div class="col-md-5 mt-3">
          <h3 class="text-warning pt-3 title">Chúng tôi là ?</h3>
          <hr />
          <img
            src="https://images.unsplash.com/photo-1490578474895-699cd4e2cf59?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=crop&w=600&h=400&q=80"
            class="img-fluid d-block rounded mx-auto image-thumbnail">
          <p class="mt-2">Baker's Mart - Thiên đường của những người yêu bánh và đam mê nghệ thuật làm bánh thủ công.</p>
          <p class="mt-2">Từ ngày đầu thành lập, chúng tôi đã không ngừng tìm kiếm và lựa chọn những sản phẩm chất lượng nhất, để mỗi khách hàng khi bước vào cửa hàng của chúng tôi đều có thể tìm thấy tất cả những gì họ cần để thỏa mãn niềm đam mê làm bánh của mình. </p>
          <p class="mt-2">Với hàng ngàn sản phẩm đa dạng từ các thương hiệu uy tín trên toàn thế giới,
                         chúng tôi tự hào là nơi cung cấp đầy đủ từ những dụng cụ cơ bản cho đến những thiết bị chuyên nghiệp nhất. Những chiếc khuôn bánh tinh xảo, những máy đánh trứng hiện đại, hay những bộ dụng cụ trang trí bánh độc đáo đều được chúng tôi lựa chọn cẩn thận để đảm bảo chất lượng tốt nhất.</p>
          <p class="mt-2">Không chỉ là một cửa hàng, chúng tôi còn là một cộng đồng cho những người yêu thích làm bánh. Mỗi khi bạn ghé thăm, bạn sẽ không chỉ tìm thấy sản phẩm phù hợp mà còn có cơ hội trao đổi, học hỏi kinh nghiệm từ những thợ làm bánh chuyên nghiệp. Chúng tôi tin rằng việc làm bánh không chỉ là công việc đơn thuần mà còn là cách để thể hiện tình yêu và sự sáng tạo trong từng chiếc bánh. Đó là lý do vì sao chúng tôi luôn đặt chất lượng và trải nghiệm khách hàng lên hàng đầu.</p>
        </div>
        <div class="col-md-5 mt-3">
          <span class="text-warning pt-3">
            <h1 class="title">LIVE SUPPORT</h1>
            <h3>24 giờ| 7 ngày một tuần| 365 ngày một năm trực tuyến</h3>
          </span>
          <hr>
          <p>Chúng tôi cam kết mang đến cho bạn trải nghiệm mua sắm tuyệt vời, không chỉ qua chất lượng sản phẩm mà còn qua từng chi tiết của dịch vụ khách hàng. </p>
          <p>Khi bạn mua sắm tại Baker's Mart, chúng tôi không chỉ cung cấp sản phẩm mà còn trao gửi niềm tin và sự hài lòng tuyệt đối. Mỗi sản phẩm bạn chọn đều được chúng tôi kiểm tra cẩn thận, đảm bảo rằng chúng đáp ứng những tiêu chuẩn cao nhất về chất lượng và an toàn. </p>
          <p>Chúng tôi hiểu rằng mỗi người làm bánh đều có những nhu cầu và kỳ vọng riêng, vì vậy đội ngũ tư vấn của chúng tôi luôn sẵn sàng lắng nghe, tư vấn và giúp bạn lựa chọn những sản phẩm phù hợp nhất với mong muốn của mình. Nếu bạn gặp bất kỳ vấn đề nào với sản phẩm đã mua, chúng tôi cam kết hỗ trợ bạn nhanh chóng và hiệu quả. Chính sách đổi trả linh hoạt của chúng tôi cho phép bạn yên tâm khi mua sắm, với thời hạn đổi trả lên đến 7 ngày sau khi nhận hàng. Đội ngũ chăm sóc khách hàng của chúng tôi, bao gồm các chuyên viên nhiệt tình và tận tâm, sẽ luôn đồng hành cùng bạn, từ khi bạn đặt hàng cho đến khi bạn hoàn toàn hài lòng với sản phẩm. </p>
          <p>Hơn thế nữa, chúng tôi không chỉ cung cấp hỗ trợ qua [email] và [hotline], mà còn qua các kênh trực tuyến như chat hỗ trợ trực tiếp và mạng xã hội, giúp bạn kết nối với chúng tôi bất cứ lúc nào, ở bất cứ đâu. </p>
          <p>Sự hài lòng của bạn không chỉ là mục tiêu mà còn là động lực để chúng tôi không ngừng nâng cao chất lượng dịch vụ. Chúng tôi tin rằng mỗi trải nghiệm mua sắm tại Baker's Mart đều sẽ là một hành trình đầy cảm hứng và thú vị, nơi bạn không chỉ tìm thấy sản phẩm mình cần mà còn cảm nhận được sự tận tình và chuyên nghiệp từ đội ngũ của chúng tôi!</p>
        </div>
      </div>
    </div>
  </div>
  <div class="container pb-3">
  </div>
  <div class="container mt-3 d-flex justify-content-center card pb-3 col-md-6">
  <form class="col-md-12" action="submit_feedback.php" method="POST" name="_next">
      <h3 class="text-warning pt-3 title mx-auto">Contact Form</h3>
      <div class="form-group">
        <label for="exampleFormControlInput1">Email address</label>
        <input type="email" class="form-control" id="exampleFormControlInput1" placeholder="Enter Your Email"
          name="email">
      </div>

      <div class="form-group">
        <label for="exampleFormControlTextarea1">Message</label>
        <textarea class="form-control" id="exampleFormControlTextarea1" name="message" rows="5"></textarea>
      </div>
      <input type="hidden" name="_next" value="http://localhost/foody/about.php" />
      <button type="submit" class="btn btn-primary">Submit</button>
    </form>
  </div>


  </div>
  <!--footer -->
  <?php include 'includes/footer.php'?>
  <!--footer end-->


</body>
<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js"></script>
<script>
  $(document).ready(function () {
    $('[data-toggle="popover"]').popover();
  });
  $(document).ready(function () {

    if (window.location.href.indexOf('#login') != -1) {
      $('#login').modal('show');
    }

  });
</script>
<?php if(isset($_GET['error'])){ $z=$_GET['error']; echo "<script type='text/javascript'>
$(document).ready(function(){
$('#signup').modal('show');
});
</script>"; echo "
<script type='text/javascript'>alert('".$z."')</script>";} ?>
<?php if(isset($_GET['errorl'])){ $z=$_GET['errorl']; echo "<script type='text/javascript'>
$(document).ready(function(){
$('#login').modal('show');
});
</script>"; echo "
<script type='text/javascript'>alert('".$z."')</script>";} ?>
</html>
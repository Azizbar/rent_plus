<?php 
session_start();
include('includes/config.php');
error_reporting(0);
if(isset($_POST['sendMessageButton']))
{
  $name=$_POST['name'];
  $email=$_POST['email'];
  $subject=$_POST['subject'];
  $message=$_POST['message']; 
   $sql="INSERT INTO tblmessage
   VALUES (NULL,'$name','$email','$subject','$message')";

    $query = $dbh->prepare($sql);
    $query->execute();
    $lastInsertId = $dbh->lastInsertId();
    if($lastInsertId)
    {
      echo "<script>alert('تم ارسال رسالتك بنجاح.');</script>";
            echo "<script type='text/javascript'> document.location = 'contact.php'; </script>";

    }
    else 
    {
      echo "<script>alert('هناك مشكلة. الرجاء المحاولة مجددا');</script>";
      echo "<script type='text/javascript'> document.location = 'contact.php'; </script>";
    } 
  
}
?>


<!DOCTYPE html>
<html lang="ar">

<head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <meta content="Free HTML Templates" name="keywords">
    <meta content="Free HTML Templates" name="description">

    <link href="img/favicon.ico" rel="icon">

    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500;700&display=swap" rel="stylesheet">  

    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.10.0/css/all.min.css" rel="stylesheet">

    <link href="lib/animate/animate.min.css" rel="stylesheet">
    <link href="lib/owlcarousel/assets/owl.carousel.min.css" rel="stylesheet">

    <link href="css/style.css" rel="stylesheet">
</head>

<body dir='rtl'>
<?php include('includes/header.php'); ?>

    <center>
   

    <div class="container-fluid pt-5 pb-3">
        <h2 class="section-title position-relative text-uppercase mx-xl-5 mb-4"><span class="bg-secondary pr-3"> تواصل معنا</span></h2>
       
    </div>
   <div class="row px-xl-1">
            <div class="col">
                <div class="bg-light p-30">
                    <div class="nav nav-tabs mb-4">
                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                        <!-- <h2> احجز الان</h2> -->
                        <aside class="col-md-6">

           
<div class="sidebar_widget">
  <div class="widget_heading">
    <h5><i class="fa fa-envelope" aria-hidden="true"></i>تواصل معنا</h5>
  </div>
  <form  method='post'>
                        <div class="control-group">
                            <input type="text" class="form-control" name="name" placeholder="ادخل اسمك"
                                required="required" />
                            <p class="help-block text-danger"></p>
                        </div>
                        <div class="control-group">
                            <input type="email" class="form-control" name="email" placeholder="ادخل بريدك الالكتروني"
                                required="required"  />
                            <p class="help-block text-danger"></p>
                        </div>
                        <div class="control-group">
                            <input type="text" class="form-control" name="subject" placeholder="ادخل العنوان"
                                required="required"/>
                            <p class="help-block text-danger"></p>
                        </div>
                        <div class="control-group">
                            <textarea class="form-control" rows="8" name="message" placeholder="ادخل رسالتك"
                                required="required"></textarea>
                            <p class="help-block text-danger"></p>
                        </div>
                        <div>
                            <button class="btn btn-primary py-2 px-4" type="submit" name="sendMessageButton">ارسال
                                </button>
                        </div>
                    </form>
</div>
</aside> </div>
                        </div>
                        </div>
                        </div>
                        </div>
    <a href="#" class="btn btn-primary back-to-top"><i class="fa fa-angle-double-up"></i></a>
   
    <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.bundle.min.js"></script>
    <script src="lib/easing/easing.min.js"></script>
    <script src="lib/owlcarousel/owl.carousel.min.js"></script>

    <script src="mail/jqBootstrapValidation.min.js"></script>
    <script src="mail/contact.js"></script>

    <script src="js/main.js"></script>
</body>

</html>
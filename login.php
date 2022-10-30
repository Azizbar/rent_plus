<?php
session_start();
include('includes/config.php');
error_reporting(0);
if(isset($_POST['login']))
{
  $email=$_POST['email'];
  $password=md5($_POST['password']);
  $sql ="SELECT EmailId,Password,FullName FROM tblusers WHERE EmailId=:email and Password=:password and type='user'";
  $query= $dbh -> prepare($sql);
  $query-> bindParam(':email', $email, PDO::PARAM_STR);
  $query-> bindParam(':password', $password, PDO::PARAM_STR);
  $query-> execute();
  $results=$query->fetchAll(PDO::FETCH_OBJ);
  if($query->rowCount() > 0)
  {
    $_SESSION['login']=$_POST['email'];
    $_SESSION['fname']=$results->FullName;
    $currentpage=$_SERVER['REQUEST_URI'];
    echo "<script type='text/javascript'> document.location = 'index.php'; </script>";
  } else{

    echo "<script>alert('Invalid Details');</script>";

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
<center>
<br><br><br><br>

    <div class="container-fluid">
    <div class="col-lg-5 mb-5">
                <div class="bg-light p-30 mb-30">
                <div class="contact-form bg-light p-30">
                    <div id="success"></div>
                            <h2 class="section-title position-relative text-uppercase mx-xl-5 mb-4"><span class="bg-secondary pr-3">تسجيل الدخول</span></h2>
                    <form  method="post">
                        <div class="control-group">
                        <input type="email" class="form-control" name="email" placeholder="البريد الالكتروني*" required="required">
                            <p class="help-block text-danger"></p>
                        </div>
                        <div class="control-group">
                        <input type="password" class="form-control" name="password" placeholder="كلمة المرور*" required="required">
                            <p class="help-block text-danger"></p>
                        </div>
                        
                        <div>
                            <button class="btn btn-primary py-2 px-4" type="submit" name="login">
                                تسجيل الدخول</button>
                        </div>
                    </form>
                    <br><p><a href="forgotpassword.php" data-toggle="modal" data-dismiss="modal" style="color: #49a3ff;">نسيت كلمة المرور؟</a></p>

                </div>
            </div>
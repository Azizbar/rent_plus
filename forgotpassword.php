<?php
session_start();
include('includes/config.php');
error_reporting(0);
if(isset($_POST['update']))
{
  $email=$_POST['email'];
  $mobile=$_POST['mobile'];
  $newpassword=md5($_POST['newpassword']);
  $sql ="SELECT EmailId FROM tblusers WHERE EmailId=:email and ContactNo=:mobile";
  $query= $dbh -> prepare($sql);
  $query-> bindParam(':email', $email, PDO::PARAM_STR);
  $query-> bindParam(':mobile', $mobile, PDO::PARAM_STR);
  $query-> execute();
  $results = $query -> fetchAll(PDO::FETCH_OBJ);
  if($query -> rowCount() > 0)
  {
    $con="update tblusers set Password=:newpassword where EmailId=:email and ContactNo=:mobile";
    $chngpwd1 = $dbh->prepare($con);
    $chngpwd1-> bindParam(':email', $email, PDO::PARAM_STR);
    $chngpwd1-> bindParam(':mobile', $mobile, PDO::PARAM_STR);
    $chngpwd1-> bindParam(':newpassword', $newpassword, PDO::PARAM_STR);
    $chngpwd1->execute();
    echo "<script>alert('نم تعديل كلمة المرور');</script>";
  }
  else {
    echo "<script>alert('البريد الالكتروني او رقم الهاتف غير صحيحين');</script>"; 
  }
}

?>
<script type="text/javascript">
  function valid()
  {
    if(document.chngpwd.newpassword.value!= document.chngpwd.confirmpassword.value)
    {
      alert("كلمتا المرور غير متطابقتين  !!");
      document.chngpwd.confirmpassword.focus();
      return false;
    }
    return true;
  }
</script>

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
                            <h2 class="section-title position-relative text-uppercase mx-xl-5 mb-4">
                                <span class="bg-secondary pr-3" style="float: right;"> استعادة كلمة المرور</span></h2>
                    <form name="chngpwd" method="post" onSubmit="return valid();">
                        <div class="control-group">
                        <input type="email" name="email" class="form-control" placeholder="البريد الالكتروني*" required="">
                            <p class="help-block text-danger"></p>
                        </div>
                        <div class="control-group">
                        <input type="text" name="mobile" class="form-control" placeholder="رقم الهاتف*" required="">
                            <p class="help-block text-danger"></p>
                        </div>
                        <div class="control-group">
                        <input type="password" name="newpassword" class="form-control" placeholder="كلمة المرور الجديدة*" required="">
                            <p class="help-block text-danger"></p>
                        </div>
                        <div class="control-group">
                        <input type="password" name="confirmpassword" class="form-control" placeholder="تأكيد كلمة المرور *" required="">
                            <p class="help-block text-danger"></p>
                        </div>
                        <div>
                            <button class="btn btn-primary py-2 px-4" type="submit" name="update">
                                 إعادة تعيين</button>
                        </div>
                    </form>
                    <br><p><a href="login.php" data-toggle="modal" data-dismiss="modal" style="color: #49a3ff;"> تسجيل الدخول</a></p>

                </div>
            </div>
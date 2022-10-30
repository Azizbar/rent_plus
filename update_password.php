<?php
session_start();
error_reporting(0);
include('includes/config.php');
if(strlen($_SESSION['login'])==0)
{ 
  header('location:index.php');
}
else{
  if(isset($_POST['updatepass']))
  {
    $password=md5($_POST['password']);
    $newpassword=md5($_POST['newpassword']);
    $email=$_SESSION['login'];
    $sql ="SELECT Password FROM tblusers WHERE EmailId=:email and Password=:password";
    $query= $dbh -> prepare($sql);
    $query-> bindParam(':email', $email, PDO::PARAM_STR);
    $query-> bindParam(':password', $password, PDO::PARAM_STR);
    $query-> execute();
    $results = $query -> fetchAll(PDO::FETCH_OBJ);
    if($query -> rowCount() > 0)
    {
      $con="update tblusers set Password=:newpassword where EmailId=:email";
      $chngpwd1 = $dbh->prepare($con);
      $chngpwd1-> bindParam(':email', $email, PDO::PARAM_STR);
      $chngpwd1-> bindParam(':newpassword', $newpassword, PDO::PARAM_STR);
      $chngpwd1->execute();
      $msg="تم تغيير كلمة المرور بنجاح";
    }
    else {
      $error="كلمة المرور خاطئة";  
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
    <script type="text/javascript">
      function valid()
      {
        if(document.chngpwd.newpassword.value!= document.chngpwd.confirmpassword.value)
        {
          alert("كلمة المرور غير متطابقتين  !!");
          document.chngpwd.confirmpassword.focus();
          return false;
        }
        return true;
      }
    </script>
    <style>
      .errorWrap {
        padding: 10px;
        margin: 0 0 20px 0;
        background: #fff;
        border-left: 4px solid #dd3d36;
        -webkit-box-shadow: 0 1px 1px 0 rgba(0,0,0,.1);
        box-shadow: 0 1px 1px 0 rgba(0,0,0,.1);
      }
      .succWrap{
        padding: 10px;
        margin: 0 0 20px 0;
        background: #fff;
        border-left: 4px solid #5cb85c;
        -webkit-box-shadow: 0 1px 1px 0 rgba(0,0,0,.1);
        box-shadow: 0 1px 1px 0 rgba(0,0,0,.1);
      }
    </style>
</head>

<body dir='rtl'>
<?php include('includes/header.php'); ?>

       <center> <h2><span>البيانات الشخصية</span><br></h2>
 
       <?php 
      $useremail=$_SESSION['login'];
      $sql = "SELECT * from tblusers where EmailId=:useremail";
      $query = $dbh -> prepare($sql);
      $query -> bindParam(':useremail',$useremail, PDO::PARAM_STR);
      $query->execute();
      $results=$query->fetchAll(PDO::FETCH_OBJ);
      $cnt=1;
      if($query->rowCount() > 0)
      {
        foreach($results as $result)
        { 
          ?>
          <section class="user_profile inner_pages">
            <div class="container">
              <div class="user_profile_info gray-bg padding_4x4_40">
                

                <div class="dealer_info">
                  <h5><?php echo htmlentities($result->FullName);?></h5>
                  <p><?php echo htmlentities($result->Address);?><br>
                    <?php echo htmlentities($result->City);?>&nbsp;<?php echo htmlentities($result->Country);?></p>
                  </div>
                </div>    
                <div class="row">
                  
                      
                
                  <div class="col-md-12 col-sm-3">
                    <div class="col-md-6 col-sm-8">
                      <div class="profile_wrap">
                        <h5 class="uppercase underline">تعديل كلمة المرور</h5>
                        <?php 
                          if($error)
                          {
                            ?>
                            <div class="errorWrap"><strong>خطأ</strong>:<?php echo htmlentities($error); ?> </div>
                            <?php 
                          } else if($msg)
                          {
                            ?>
                            <div class="succWrap"><strong>تم</strong>:<?php echo htmlentities($msg); ?> </div>
                            <?php
                          }?>
                        <form name="chngpwd" method="post" onSubmit="return valid();">
                          <div class="form-group">
                            <label class="control-label">تاريخ التسجيل -</label>
                            <?php echo htmlentities($result->RegDate);?>
                          </div>
                          <?php if($result->UpdationDate!="")
                          {
                            ?>
                            <div class="form-group">
                              <label class="control-label">آخر تحديث  -</label>
                              <?php echo htmlentities($result->UpdationDate);?>
                            </div>
                            <?php 
                          } ?>
                          <div class="form-group">
                          <label class="control-label">كلمة المرور الحالية</label>
                            <input class="form-control white_bg" id="password" name="password"  type="password" required>
                          </div>
                          <div class="form-group">
                            <label class="control-label">كلمة المرور الجدبدة</label>
                            <input class="form-control white_bg" id="newpassword" type="password" name="newpassword" required>
                          </div>
                          <div class="form-group">
                            <label class="control-label">تأكيد كلمة المرور </label>
                            <input class="form-control white_bg" id="confirmpassword" type="password" name="confirmpassword"  required>
                          </div>

                          <div class="form-group">
                          
                            <input type="submit" value="تعديل" name="updatepass" id="submit" class="btn bg-primary" style="background-color: #49a3ff;">
                          </div>
                        </form>
                      </div>
                    </div>
                  </div>
                </div>
              </section>
              <?php 
            }
          } ?>
    
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
<?php 
    } ?>
<?php
session_start();
error_reporting(0);
include('includes/config.php');
if(strlen($_SESSION['login'])==0)
{ 
  header('location:index.php');
}
else{
    $username=$_SESSION['login'];
    if(isset($_POST['submit']))
    {
        $card=$_POST['card'];
      $booking_id=$_POST['booking_id'];
      $total=$_POST['total'];
      include "includes/connect.php";
        mysqli_query($con,"UPDATE tblbooking set payment_status='1' WHERE id = '$booking_id'");
        $sql="INSERT INTO tblpayment
        VALUES (NULL,:booking_id,:card,:username,:total)";
       $query = $dbh->prepare($sql);
       $query->bindParam(':username',$username,PDO::PARAM_STR);
       $query->bindParam(':booking_id',$booking_id,PDO::PARAM_STR);
       $query->bindParam(':card',$card,PDO::PARAM_STR);
       $query->bindParam(':total',$total,PDO::PARAM_STR);
       $query->execute();
       $lastInsertId = $dbh->lastInsertId();
       
       if($lastInsertId)
       {
         echo "<script>alert('تم الحجز بنجاح.');</script>";
         echo "<script type='text/javascript'> document.location = 'index.php'; </script>";
       }
       else 
       {
         echo "<script>alert('هناك مشكلة. الرجاء المحاولة مجددا');</script>";
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

       <center> <h2><span>بيانات الحجز</span><br></h2>
 
       <?php 
          $id=intval($_GET['id']);
          $sql = "SELECT * from tblbooking where id='$id'";
          $query = $dbh -> prepare($sql);
          $query->execute();
          $results=$query->fetchAll(PDO::FETCH_OBJ);
          $cnt=1;
          if($query->rowCount() > 0)
          {
            foreach($results as $result)
            {  
              $_SESSION['brndid']=$result->bid;  
              ?>  
          <section class="user_profile inner_pages">
            <div class="container">
              <div class="user_profile_info gray-bg padding_4x4_40">
                

                <div class="dealer_info">
                <?php $booking_id= htmlentities($result->id);?>
                  <h5><?php echo htmlentities($result->device_name);?></h5>
                  <strong> تاريخ الحجز: <?php echo htmlentities($result->booking_date);?></strong><br>
                  <strong>   مدة الحجز: <?php echo htmlentities($result->booking_type);?></strong><br>
                  <strong>  مدة الحجز: <?php echo htmlentities($result->booking_duration);?>&nbsp; <?php echo htmlentities($result->booking_type);?></strong><br>
                    <strong> اجمالي السعر: <?php echo htmlentities($result->total);?>&nbsp;ريال سعودي </strong><br>

                   </div>
                </div>    
                <div class="row">
                  
                      
                
                  <div class="col-md-12 col-sm-3">
                    <div class="col-md-6 col-sm-8">
                      <div class="profile_wrap">
                        <h5 class="uppercase underline">بيانات الدفع</h5>
                        <?php  
                        if($msg)
                        {
                          ?>
                          <div class="succWrap">
                            <strong>تم</strong>:<?php echo htmlentities($msg); ?> 
                          </div>
                          <?php
                        }
                             $total=htmlentities($result->total);
                             ?>
                        <form  method="post">
                          <div class="form-group">
                          <label>المبلغ الاجمالي</label>
                  <input type="text" class="form-control" name="total" value="<?php echo $total;?>" required readonly>
                  <input type="hidden" class="form-control" name="booking_id" value="<?php echo $booking_id;?>" required>
                </div>
                <div class="form-group">
                  <label>رقم البطاقة</label>
                  <input type="text" class="form-control" name="card" placeholder="الرجاء ادخال رقم البطاقة" required>
                </div>
                <br>
                <?php if($_SESSION['login'])
                {?>
                  <div class="form-group">
                  <button type="submit" name="submit" class="btn bg-primary"  style="background-color: #49a3ff;"  >ادفع الان <span class="angle_arrow"><i class="fa fa-angle-right"  style="color: #49a3ff;"  aria-hidden="true"></i></span></button>
                 </div>
                  <?php 
                } else { ?>
                  <a href="login.php" class="btn bg-primary" data-toggle="modal" data-dismiss="modal" style="background-color: #49a3ff;">تسجيل الدخول من اجل الحجز</a>

                  <?php 
                } ?>
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
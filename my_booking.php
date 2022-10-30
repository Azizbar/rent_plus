<?php
session_start();
error_reporting(0);
include('includes/config.php');
if(strlen($_SESSION['login'])==0)
{ 
  header('location:index.php');
}
else{
    $email=$_SESSION['login'];
    if(isset($_REQUEST['id']))
    {    
  $id=intval($_GET['id']);
  $sql = "delete from tblbooking  WHERE  id=:id and username=:email";
  $query = $dbh->prepare($sql);
  $query -> bindParam(':id',$id, PDO::PARAM_STR);
  $query -> bindParam(':email',$email, PDO::PARAM_STR);
  $query -> execute();
  
   echo "<script>alert('تم الغاء الحجز.');</script>";
  
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

    <div class="container-fluid pt-5 pb-3">
        <h2 class="section-title position-relative text-uppercase mx-xl-5 mb-4">
        <center>
        <span class="bg-secondary pr-3">حجوزاتي</span></h2>
        <div class="row px-xl-5">
        <?php 
                    $useremail=$_SESSION['login'];
                    $sql = "SELECT * from tblbooking where username=:useremail";
                    $query = $dbh -> prepare($sql);
                    $query-> bindParam(':useremail', $useremail, PDO::PARAM_STR);
                    $query->execute();
                    $results=$query->fetchAll(PDO::FETCH_OBJ);
                    $cnt=1;
                    if($query->rowCount() > 0)
                    {
                      foreach($results as $result)
                      {  
                       $status= htmlentities($result->status);
                       $pay= htmlentities($result->payment_status);
                       if($status==0){
                       $stat="انتظار الموافقة";
                       }else{
                        $stat="تمت الموافقة على طلب الحجز";
                       }
                       if($status==1 && $pay==1){
                        $stat="تم الدفع";
                       }
                        ?>
            <div class="col-lg-6 col-md-4 col-sm-6 pb-1">
                <div class="product-item bg-light mb-6">
                    
                    <div class="text-center py-4">
                    <h6>اسم الجهاز: <?php echo htmlentities($result->device_name);?></h6>
                            <p><b>تاريخ الحجز : </b> <?php echo htmlentities($result->booking_date);?></p>
                            <p><b> نوع مدة الحجز: <?php echo htmlentities($result->booking_type);?></b></p>
                            <p><b>  مدة الحجز : </b> <?php echo htmlentities($result->booking_duration);?></p>
                            <p><b>السعر الاجمالي : </b> <?php echo htmlentities($result->total);?></p>
                            <p><b> حالة الحجز:  <?php echo $stat;?></b></p>
                            <?php 
                            switch ($stat){
                                case "انتظار الموافقة":
                                ?>
                                <a href="my_booking.php?id=<?php echo htmlentities($result->id);?>" 
                            onclick="return confirm('هل انت متأكد من الغاء الحجز؟');" class="btn bg-primary" style="background-color: #49a3ff;" >
                            الغاءالحجز <span class="angle_arrow"></span></a>
                            <?php
                            break;
                            case "تمت الموافقة على طلب الحجز":
                            ?>
                            <a href="payment.php?id=<?php echo htmlentities($result->id);?>" 
                                class="btn bg-primary" style="background-color: #49a3ff;">
                            اضغط من أجل الدفع <span class="angle_arrow"></span></a>
                            <?php
                            break;
                             case "تم الدفع":
                             ?>
                             <a href="#" 
                                class="btn bg-primary" style="background-color: #49a3ff;">
                            تم الدفع <span class="angle_arrow"></span></a>
                            <?php
                            break;
                            }
                            ?>
                        

           
                    </div>
                    
                </div>
                
            </div>
            <?php }}else { 
                  ?>
                  <h5 align="center" style="color:red">ليست هناك حجوزات بعد</h5>
                  <?php 
                } ?>
            </div>
            
        </div>
        
    </div>
    
    <!-- Back to Top -->
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
    } 
    ?>
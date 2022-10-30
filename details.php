<?php 
session_start();
include('includes/config.php');
error_reporting(0);
$vhid=intval($_GET['vhid']);

if(isset($_POST['submit']))
{
  $fromdate=$_POST['fromdate'];
  $date= date("Y/m/d"); 
  $date2=strtotime($date);
  $fromdate2=strtotime($fromdate);
  $duration=$_POST['duration'];
  $time=$_POST['time'];
  include "includes/connect.php";

  if($time=='hour'){
    $chk = mysqli_query($con,"SELECT PricePerHour FROM devices WHERE id = '$vhid'");
						while($user = mysqli_fetch_array($chk))
						{
			       $hour=$user[0];
           } 
           $total =$hour*$duration;
  }

  if($time=='day'){
    $chk = mysqli_query($con,"SELECT PricePerDay FROM devices WHERE id = '$vhid'");
						while($user = mysqli_fetch_array($chk))
						{
			       $day=$user[0];
           }
           $total=$day*$duration;
  }


  $useremail=$_SESSION['login'];

  $vhid=$_GET['vhid'];
 
   $sql3 = "SELECT device_name,device_owner FROM devices WHERE id = '$vhid'";
                    $query3 = $dbh -> prepare($sql3);
                    $query3->execute();
                    $results3=$query3->fetchAll(PDO::FETCH_OBJ);
                    
                    if($query3->rowCount() > 0)
                    {
                      foreach($results3 as $result3)
                      {
                        $device= htmlentities($result3->device_name);
                        $owner= htmlentities($result3->device_owner);
                      }}
// //valid date
$sql4 = "SELECT booking_date from tblbooking where device_name='$device' and booking_date='$fromdate'";
                    $query4 = $dbh -> prepare($sql4);
                    $query4->execute();
                    $results4=$query4->fetchAll(PDO::FETCH_OBJ);
                    
                    if($query4->rowCount() > 0)
                    {
                      foreach($results4 as $result4)
                      {
                        $bookDate= htmlentities($result4->booking_date);
                      }}
   if($bookDate==$fromdate){
    echo "<script>alert('لا يمكنك حجز هذا الجهاز في هذا التاريخ بسبب وجود حجز مسبق له.');</script>";
   }else{

    if($fromdate2 > $date2){    
   $sql="INSERT INTO tblbooking
   VALUES (NULL,'$device','$fromdate','$time','$duration','$total','$useremail','$owner',0,0)";

    $query = $dbh->prepare($sql);
    $query->execute();
    $lastInsertId = $dbh->lastInsertId();
    if($lastInsertId)
    {
      echo "<script>alert('تم الحجز بنجاح ، الرجاء انتظار الرد من مالك الجهاز.');</script>";
            echo "<script type='text/javascript'> document.location = 'index.php'; </script>";

    }
    else 
    {
      echo "<script>alert('هناك مشكلة. الرجاء المحاولة مجددا');</script>";
      echo "<script type='text/javascript'> document.location = 'index.php'; </script>";
    } 
  }else{
    echo "<script>alert('لا يمكنك اختيار يوم من الماضي');</script>";
  }
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
        <h2 class="section-title position-relative text-uppercase mx-xl-5 mb-4"><span class="bg-secondary pr-3"> تفاصيل الجهاز</span></h2>
       
    </div>
    <!-- Products End -->
    <div class="container-fluid pb-5">
        <div class="row px-xl-5">
            <div class="col-lg-5 mb-30">
                <div id="product-carousel" class="carousel slide" data-ride="carousel">
                    <div class="carousel-inner bg-light">
                        <div class="carousel-item active">
                        <?php 
          $vhid=intval($_GET['vhid']);
          
          
          $sql = "SELECT * FROM `devices` WHERE id =:vhid";
          $query = $dbh -> prepare($sql);
          $query->bindParam(':vhid',$vhid, PDO::PARAM_STR);
          $query->execute();
          $results=$query->fetchAll(PDO::FETCH_OBJ);
          $cnt=1;
          if($query->rowCount() > 0)
          {
            foreach($results as $result)
            {  
              $_SESSION['brndid']=$result->bid;  
              $owner=htmlentities($result->device_owner);
              ?> 
              <?php
                 $sql2 = "SELECT * FROM `tblusers` WHERE FullName ='$owner'";
                 $query2 = $dbh -> prepare($sql2);
                 $query2->execute();
                 $results2=$query2->fetchAll(PDO::FETCH_OBJ);
                 if($query2->rowCount() > 0)
                 {
                   foreach($results2 as $result2)
                   {  
                ?> 
                            <img class="w-100 h-100" src="img/<?php echo htmlentities($result->front_image);?>" alt="Image">
                        </div>
                        <div class="carousel-item">
                            <img class="w-100 h-100" src="img/<?php echo htmlentities($result->behind_image);?>" alt="Image">
                        </div>
                        <div class="carousel-item">
                            <img class="w-100 h-100" src="img/<?php echo htmlentities($result->dimage);?>" alt="Image">
                        </div>
                       
                    </div>
                    <a class="carousel-control-prev" href="#product-carousel" data-slide="prev">
                        <i class="fa fa-2x fa-angle-left text-dark"></i>
                    </a>
                    <a class="carousel-control-next" href="#product-carousel" data-slide="next">
                        <i class="fa fa-2x fa-angle-right text-dark"></i>
                    </a>
            </div>
            </div>
            <div class="col-lg-7 h-auto mb-30">
                <div class="h-100 bg-light p-30">
                    
            <div class="container">
              
                  <h2><?php echo htmlentities($result->device_name);?>  <br>
                  التفاصيل: <?php echo htmlentities($result->device_desc);?></h2>
                </div>
                  <hr>
                  <strong>اسم مالك الجهاز: <?php echo htmlentities($result2->FullName);?> </strong><br>
                  <strong>  بريد مالك الجهاز: <?php echo htmlentities($result2->EmailId);?> </strong><br>
                  <strong>  هاتف مالك الجهاز: <?php echo htmlentities($result2->ContactNo);?> </strong><br>
                  <strong>عنوان مالك الجهاز : </strong><?php echo htmlentities($result2->Address);?><br>
                  <strong> مدينة مالك الجهاز : </strong><?php echo htmlentities($result2->City);?><br>


                  <?php
                   }}
                  ?>
                  <strong>سعر الساعة: <?php echo htmlentities($result->PricePerHour);?>&nbsp;ريال سعودي </strong><br>
                  <strong>سعر اليوم: <?php echo htmlentities($result->PricePerDay);?>&nbsp;ريال سعودي </strong><br>

                  </div>
                </div>
              </div>
          
                </div>
            </div>
   <?php }} ?>
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
    <h5><i class="fa fa-envelope" aria-hidden="true"></i>احجز الان</h5>
  </div>
  <form method="post">
    <div class="form-group">
      <label> تاريخ الحجز</label>
      <?php $past= date("Y/m/d"); ?>
      <input type="date" class="form-control" name="fromdate" placeholder="From Date" min='<?php echo $past;?>' required>
    </div>
    <div class="form-group">
      <label>نوع مدة الاستئجار</label>
      <select class="form-control" name="time" required>
      <option ></option>
      <option value='hour' name='hour'>ساعة</option>
      <option value='day' name='day'>يوم</option>
      </select>
    </div>
    <div class="form-group">
      <label>كمية المدة</label>
      <input type="number" class="form-control" name="duration" placeholder="ساعة او ساعتين\يوم او يومين" required>
    </div>
    <br>

    <?php if($_SESSION['login'])
    {?>
      <div class="form-group">
        <input type="submit" class="btn" style="background-color: #ffc107;"  name="submit" value="احجز الان">
      </div>
      <?php 
    } else { ?><center>
   <a href="login.php" class="btn" style="background-color: #ffc107;" >
   تسجيل الدخول من اجل الحجز</a>

      <?php 
    } ?>
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
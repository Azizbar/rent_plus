<?php 
session_start();
include('includes/config.php');
error_reporting(0);
$vhid=intval($_GET['vhid']);

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
                       $img= htmlentities($result->behind_image);
                       $img2= htmlentities($result->dimage);
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
              
            <img class="w-100 h-100" src="img/<?php echo $img;?>" alt="Image">

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
  <img class="w-100 h-100" src="img/<?php echo $img2;?>" alt="Image">
</aside> </div>
                   <?php }} ?>
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
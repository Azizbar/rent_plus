<?php
session_start();
include('includes/config.php');
error_reporting(0);
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
        <h2 class="section-title position-relative text-uppercase mx-xl-5 mb-4"><span class="bg-secondary pr-3">  الألعاب</span></h2>
        <div class="row px-xl-5">
        <?php
                        $sql="SELECT * from devices where device_type='games' and block_status=1";
                            $query = $dbh -> prepare($sql);
                        $query->execute();
                        $results=$query->fetchAll(PDO::FETCH_OBJ);
                        $cnt=1;
                        if($query->rowCount() > 0)
                        {
                            foreach($results as $result)
                            {  
                            ?> 
            <div class="col-lg-3 col-md-4 col-sm-6 pb-1">
                <div class="product-item bg-light mb-4">
                    <div class="product-img position-relative overflow-hidden">
                    <a href="details.php?vhid=<?php echo htmlentities($result->id);?>">
                        <img  height='150px' width='250px' src="img/<?php echo htmlentities($result->front_image);?>" alt="">
                       
                       
                    </div>
                    <div class="text-center py-4">
                    
                    <a class="h6 text-decoration-none text-truncate" href="details.php?vhid=<?php echo htmlentities($result->id);?>">
                    اسم الجهاز:    
                                        
 
                    <?php echo htmlentities($result->device_name);?>
                    <br> </a>
                    <a href="rate.php?vhid=<?php echo htmlentities($result->id);?>" class="btn" style="background-color: #ffc107;" >
   عرض التقييم</a>

           
                    </div>
                    
                </div>
                
            </div>
            <?php }} ?>
            </div>
            
        </div>
        
    </div>
    
    <!-- Products End -->


   
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
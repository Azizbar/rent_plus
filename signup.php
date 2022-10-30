<?php
session_start();
include('includes/config.php');
error_reporting(0);
if(isset($_POST['signup']))
{
$fname=$_POST['fullname'];
$email=$_POST['emailid']; 
$mobile=$_POST['mobileno'];
$address=$_POST['address'];
$city=$_POST['city']; 
$country=$_POST['country'];
$password=md5($_POST['password']);
$date= date("y/m/d"); 
$sql2 ="SELECT FullName,EmailId FROM tblusers WHERE FullName='$fname' or EmailId='$email'";
$query2= $dbh -> prepare($sql2);
$query2-> execute();
$results2 = $query2 -> fetchAll(PDO::FETCH_OBJ);
$cnt2=1;
if($query2 -> rowCount() > 0)
{
  echo "<script>alert('اسم المستخدم او البريد الالكتروني موجود مسبقا. الرجاء ادخال اسم آخر');</script>";
} else{
$sql="INSERT INTO  tblusers VALUES(NULL,'user','$fname','$email','$password','$mobile','$address','$city','$country','$date')";
$query = $dbh->prepare($sql);
$query->execute();
$lastInsertId = $dbh->lastInsertId();
if($lastInsertId)
{
echo "<script>alert('تم تسجيل الحساب الجديد بنجاح');</script>";
}
else 
{
echo "<script>alert('هناك خطأ يرجى ادخال البيانات بشكل صحيح');</script>";
}
}
}

?>


<script>
function CheckPassword(inputtxt) 
{ 
var passw=  /^(?=.*\d)(?=.*[a-z])(?=.*[A-Z])(?=.*[^a-zA-Z0-9])(?!.*\s).{8}$/;

if(inputtxt.value.match(passw)) 
{ 
// alert('')
return true;
}
else
{ 
alert('يجب ان تتضمن كلمة المرور على حروف كبيرة وصغيرة ورموز وارقام')
return false;
}
}
function checkAvailability() {

}
</script>
<script type="text/javascript">
function valid()
{



if(document.signup.password.value!= document.signup.confirmpassword.value)
{
alert("كلمتا المرور غير متطابفتين  !!");
document.signup.confirmpassword.focus();
return false;
}
return true;
}

</script>

<!DOCTYPE html>
<html lang="ar">

<head>
    <meta charset="utf-8">
    <title>رنت بلس</title>
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <meta content="Free HTML Templates" name="keywords">
    <meta content="Free HTML Templates" name="description">

    <!-- Favicon -->
    <link href="img/favicon.ico" rel="icon">

    <!-- Google Web Fonts -->
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500;700&display=swap" rel="stylesheet">  

    <!-- Font Awesome -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.10.0/css/all.min.css" rel="stylesheet">

    <!-- Libraries Stylesheet -->
    <link href="lib/animate/animate.min.css" rel="stylesheet">
    <link href="lib/owlcarousel/assets/owl.carousel.min.css" rel="stylesheet">

    <!-- Customized Bootstrap Stylesheet -->
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
                                <span class="bg-secondary pr-3">تسجيل حساب جديد</span></h2>
                                <form  method="post" name="signup" onSubmit="return valid();">
                        <div class="control-group">
                        <input type="text" class="form-control" name="fullname" placeholder="الاسم الكامل" min='2' required="required">
                            <p class="help-block text-danger"></p>
                        </div>
                        <div class="control-group">
                        <input type="number" class="form-control" name="mobileno" placeholder="رقم الهاتف" min='8' required="required">
                            <p class="help-block text-danger"></p>
                        </div>
                        <div class="control-group">
                        <input type="email" class="form-control" name="emailid" id="emailid" onBlur="checkAvailability()" placeholder="البريد الالكتروني" required="required">
                   <span id="user-availability-status" style="font-size:12px;"></span> 
                       <p class="help-block text-danger"></p>
                        </div>
                        <div class="control-group">
                        <div class="input-group"><!-- input-group Starts -->

                        <span class="input-group-addon"><!-- input-group-addon Starts -->

                        <i class="fa fa-check tick1"> </i>

                        <i class="fa fa-times cross1"> </i>

                        </span><!-- input-group-addon Ends -->

                        <input type="password" class="form-control" id="pass" name="password" onBlur="password()" placeholder="كلمة المرور" min='4' max='30' required="required">
                        <span class="input-group-addon"><!-- input-group-addon Starts -->

                        <div id="meter_wrapper"><!-- meter_wrapper Starts -->

                        <span id="pass_type"> </span>

                        <div id="meter"> </div>

                        </div><!-- meter_wrapper Ends -->

                        </span><!-- input-group-addon Ends -->

                        </div><!-- input-group Ends -->
                        <p class="help-block text-danger"></p>

                        </div><!-- form-group Ends -->

                        <!-- </div> -->
                        <div class="control-group">
                        <input type="password" class="form-control" name="confirmpassword" min='4' max='30' placeholder="تأكيد كلمة المرور" required="required">
                            <p class="help-block text-danger"></p>
                        </div>
                        <div class="control-group">
                        <input type="text" class="form-control" name="address" placeholder="العنوان" maxlength="10" required="required">
                            <p class="help-block text-danger"></p>
                        </div>
                        <div class="control-group">
                        <input type="text" class="form-control" name="city" placeholder="المدينة" maxlength="10" required="required">
                            <p class="help-block text-danger"></p>
                        </div>
                        <div class="control-group">
                        <input type="text" class="form-control" name="country" placeholder="الدولة" maxlength="50" required="required">
                            <p class="help-block text-danger"></p>
                        </div>
                        <div>
                            <button class="btn btn-primary py-2 px-4" type="submit" name="signup" onclick="CheckPassword(document.signup.password)">
                                 حفظ</button>
                        </div>
                    </form>
                    <br><p><a href="login.php"  style="color: #49a3ff;">  تسجيل الدخول</a></p>

                </div>
            </div>
            <script src="js/jquery.min.js"> </script>

<script src="js/bootstrap.min.js"></script>

<script>

$(document).ready(function(){

$('.tick1').hide();
$('.cross1').hide();

$('.tick2').hide();
$('.cross2').hide();


$('.confirm').focusout(function(){

var password = $('#pass').val();

var confirmPassword = $('#con_pass').val();

if(password == confirmPassword){

$('.tick1').show();
$('.cross1').hide();

$('.tick2').show();
$('.cross2').hide();



}
else{

$('.tick1').hide();
$('.cross1').show();

$('.tick2').hide();
$('.cross2').show();


}


});


});

</script>

<script>

$(document).ready(function(){

$("#pass").keyup(function(){

check_pass();

});

});

function check_pass() {
 var val=document.getElementById("pass").value;
 var meter=document.getElementById("meter");
 var no=0;
 if(val!="")
 {
// If the password length is less than or equal to 6
if(val.length<=6)no=1;

 // If the password length is greater than 6 and contain any lowercase alphabet or any number or any special character
  if(val.length>6 && (val.match(/[a-z]/) || val.match(/\d+/) || val.match(/.[!,@,#,$,%,^,&,*,?,_,~,-,(,)]/)))no=2;

  // If the password length is greater than 6 and contain alphabet,number,special character respectively
  if(val.length>6 && ((val.match(/[a-z]/) && val.match(/\d+/)) || (val.match(/\d+/) && val.match(/.[!,@,#,$,%,^,&,*,?,_,~,-,(,)]/)) || (val.match(/[a-z]/) && val.match(/.[!,@,#,$,%,^,&,*,?,_,~,-,(,)]/))))no=3;

  // If the password length is greater than 6 and must contain alphabets,numbers and special characters
  if(val.length>6 && val.match(/[a-z]/) && val.match(/\d+/) && val.match(/.[!,@,#,$,%,^,&,*,?,_,~,-,(,)]/))no=4;

  if(no==1)
  {
   $("#meter").animate({width:'50px'},300);
   meter.style.backgroundColor="red";
   document.getElementById("pass_type").innerHTML="ضعيفة جدا";
  }

  if(no==2)
  {
   $("#meter").animate({width:'100px'},300);
   meter.style.backgroundColor="#F5BCA9";
   document.getElementById("pass_type").innerHTML="ضعيفة";
  }

  if(no==3)
  {
   $("#meter").animate({width:'150px'},300);
   meter.style.backgroundColor="#FF8000";
   document.getElementById("pass_type").innerHTML="جيدة";
  }

  if(no==4)
  {
   $("#meter").animate({width:'200px'},300);
   meter.style.backgroundColor="#00FF40";
   document.getElementById("pass_type").innerHTML="قوية";
  }
 }

 else
 {
  meter.style.backgroundColor="";
  document.getElementById("pass_type").innerHTML="";
 }
}

</script>
          
</body>
</html>
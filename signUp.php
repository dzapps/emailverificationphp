<?php
$servername="localhost";
$username = "root";
$password = "";
$dbname = "future";
$error=NULL;
$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
  $error="Database Connection Failed";
  die("Connection failed: " . $conn->connect_error);
}
if(isset($_POST['submit'])){
  $fname=$_POST["fname"];
  $lname=$_POST["lname"];
  $name = $fname." ".$lname;
  $email=$_POST["email"];
  $pass=$_POST["password"];
  $vkey=md5(time().$email);
  $pass=md5($pass);
  $sql="INSERT INTO users (name,email,password,vkey) VALUES ('$name','$email','$pass','$vkey')";
  if($conn->query($sql)){
    $to=$email;
    $subject="Please verify your email address";
    $message="Dear $fname, Click <a href='http://localhost/mailverification/verify.php?vkey=$vkey'>here</a> to verify your account.";
    $headers="From: emailverificationbot100@yahoo.com \r\n";
    $headers.="MIME-Version:1.0" . "\r\n";
    $headers.="Content-type:text/html;charset=UTF-8" . "\r\n";
    mail($to,$subject,$message,$headers);
    header("location:login.php");
  }
  else {
    echo "\n Error: \n" . $sql . "<br>" . $conn->error;
  }
}
?>




<!DOCTYPE html>
<html lang="en" dir="ltr">

<head>
  <meta charset="utf-8">
  <title>Sign Up</title>
  <link rel="stylesheet" type="text/css" href="css/signUp.css">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js"></script>
  <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.4.1/js/bootstrap-datepicker.min.js"></script>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.4.1/css/bootstrap-datepicker3.css" />
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
</head>

<body>
  <div class="container-fluid">
    <div class="row justify-content-center">
      <div class="col-sm-4">
        <form class="form-container" method="post" action="">
          <h1 align="center">SIGN UP</h1>
          <div class="row">
            <div class="col-sm-6">
              <input required type="text" class="form-control" placeholder="First Name" name="fname" pattern="[A-Za-z]{1,15}" title="Must Contain Letters">
            </div>
            <div class="col-sm-6">
              <input required type="text" class="form-control" placeholder="Last Name" name="lname" pattern="[A-Za-z]{1,15}" title="Must Contain Letters">
            </div>
          </div>
          <input required type="email" class="form-control" placeholder="Email" name="email" style="margin-top:10px" pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,3}$" title="Invalid Email Id">
          <input required type="password" class="form-control" placeholder="Password" name="password" style="margin-top:10px" pattern="[A-Za-z0-9]{6,12}" title="Password must contain 6 to 12 characters!">
          <input type="submit" name="submit" class="btn btn-info" value="Sign Up" style="width:100%;height:40px;font-size: 14px;margin-top:30px" required></input>
        </form>
      </div>
    </div>
  </div>
</body>
<?php
echo $error;
?>
</html>

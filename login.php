<?php
$servername="localhost";
$username = "root";
$password = "shivam";
$dbname = "future";
$error=NULL;
$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
  $error="Database Connection Failed";
  die("Connection failed: " . $conn->connect_error);
}
if(isset($_POST['submit'])){
  $email=$_POST["email"];
  $pass=$_POST["password"];
  $pass=md5($pass);
  $resultSet=$conn->query("SELECT * FROM users WHERE email='$email' AND password='$pass' LIMIT 1");
  if ($resultSet) {
    $row=$resultSet->fetch_assoc();
    $verified=$row['verified'];
    if ($verified==1) {
      echo "Welcome.";
    } else {
      echo "Account has not been verified. An email was sent to '$email'";
    }

  } else {
    echo "Sign Up First";
    header("location:signUp.php");
  }

}
?>
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
      <div class="col-sm-3">
        <form class="form-container" method="post" action="">
          <h1 align="center">LOG IN</h1>
          <input required type="email" class="form-control" placeholder="Email" name="email" style="margin-top:10px" pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,3}$" title="Invalid Email Id">
          <input required type="password" class="form-control" placeholder="Password" name="password" style="margin-top:10px" pattern="[A-Za-z0-9]{6,12}" title="Password must contain 6 to 12 characters!">
          <input type="submit" name="submit" class="btn btn-info" value="Log In" style="width:100%;height:40px;font-size: 14px;margin-top:30px" required></input>
        </form>
      </div>
    </div>
  </div>
</body>
<?php
echo $error;
?>
</html>

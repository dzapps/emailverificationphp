<?php
if(isset($_GET['vkey'])){
  $vkey=$_GET['vkey'];
  $servername="localhost";
  $username = "root";
  $password = "";
  $dbname = "future";
  $conn = new mysqli($servername, $username, $password, $dbname);
  if ($conn->connect_error) {
    $error="Database Connection Failed";
    die("Connection failed: " . $conn->connect_error);
  }
  $sql="SELECT verified,vkey FROM users WHERE verified 0 AND vkey='$vkey' LIMIT 1";
  $resultSet=$conn->query($sql);
  $update=$conn->query("UPDATE users SET verified=1 WHERE vkey='$vkey' LIMIT 1");
    if ($update) {
      echo "Your account is verified, you may now log in.";
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
    <title></title>
  </head>
  <body>

  </body>
</html>

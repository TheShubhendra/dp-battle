<?php
require'dbConnect.php';
session_start();
    if ($_SESSION["loggedIn"]){
        mysqli_close($conn);
        header("location: index.php");
        exit();
    }
    if (isset($_COOKIE["id"]) && isset($_COOKIE["token"])){
        
        mysqli_close($conn);
        header("location: autoLogin.php");
       exit();
    }
if ($_SERVER["REQUEST_METHOD"] == "POST"){
    
    $phone = $_POST["phone"];
    $password = $_POST["password"];

    $sql = "SELECT id FROM userData WHERE phone = '$phone';";
    
  $result =  $conn->query($sql);
function checkPass($enteredPass, $dbPass){
    return $enteredPass==$dbPass;
}
if ($result->num_rows > 0) {
  
  $row = $result->fetch_assoc();
$id = $row["id"];
$result = $conn->query("SELECT password FROM loginData WHERE id =$id;");
$row = $result->fetch_assoc();
  if(checkPass($password, $row["password"])){

$_SESSION["id"] = $id;
$result = $conn->query("SELECT name FROM userData WHERE id = $id;");
$row = $result->fetch_assoc();
$name = $row["name"];
$token = bin2hex(openssl_random_pseudo_bytes(16));

 $_SESSION["name"] = $name;
 $ip = $_SERVER["REMOTE_ADDR"];
 $userAgent = $_SERVER["HTTP_USER_AGENT"];
 $sql ="UPDATE `loginData` SET token ='$token' , lastIp = '$ip' , lastUserAgent = '$userAgent' WHERE id = $id";
 $conn->query($sql);
 $_SESSION["loggedIn"] = true;

setcookie("id",$id,time()+365*24*60*60,"/");
 setcookie("token",$token,time()+365*24*60*60,"/");
mysqli_close($conn);
if(isset($_SESSION["ref"])){
header("location: ".$_SESSION["ref"]);
        }else{
header("location: index.php");
        }
        
exit();
  }else{
      echo '<div class="error alert alert-warning alert-dismissible">
  <button type="button" class="close" data-dismiss="alert">&times;</button>
  <strong>Login Error!</strong>Wrong Password
</div>';
  }
  
} else {
  echo '<div class="error  alert alert-warning alert-dismissible">
  <button type="button" class="close" data-dismiss="alert">&times;</button>
  <strong>Login Error!</strong> No.is not registered
</div>';
}
}
mysqli_close($conn);
    ?>
<!doctype html>
    <html>
    <head>
  <meta name="theme-color" content="#e26c11e6">
        <meta name="viewport" content="width=device-width,initial-scale=1.0">
<link href="https://fonts.googleapis.com/css?family=Dancing+Script|Nunito|Pacifico|Poor+Story|Shadows+Into+Light&display=swap" rel="stylesheet">
<link href="https://fonts.googleapis.com/css2?family=Metal+Mania&display=swap" rel="stylesheet">


<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"></script>
   

<style>
body{
 
  background-color:#80b3ff;
}
.loginbox{
  margin-top:10%;
  width: 80%;
  background: #111111;
  border-radius:3%;
}
.loginbox .h1{
  color: #f8881df1;
font-family: 'Poor Story', cursive;
}
.loginbox input[type = "number"],.loginbox input[type = "password"]{
  margin: 20px auto;
  text-align: center;
  border: 1px solid #3498db;
  width: 70%;
  outline: none;
  color: green;
  border-radius: 100px;
  transition: 0.25s;
  font-family:courier;
  background-color: black;
}
.loginbox input[type = "number"]:focus ,.loginbox input[type = "password"]:focus{
  width: 90%;
  border-color: #2ecc71;
}
.loginbox input[type = "submit"]{
  width: 40%;
  margin: 20px auto;

  border-radius: 24px;
  transition: 0.1s;
  cursor: pointer;
}
.loginbox input[type = "submit"]:hover{
  background: #2ecc71;
}
.error{

     text-align:center;
     font-size: 200%;
font-family: 'Metal Mania' ,Cursive;
}
a{
	text-decoration:none;
    color:hotpink;
}
#h2{
    padding:10px;
font-family: 'Shadows Into Light', cursive;
color:powderblue;
font-weight:20;
font-size:22px;
}
.link a {
    background-color:#000000;
    border-style:solid;
    border-radius:10px;
    border-width:1px;
    font-size:65%;
}

</style>



    </head>
  <body>

	<div id="form" class="container  loginbox">
	<div class="h1 text-center display-2">Log In</div>
	<form target ="" method="POST" autofill="true"autocomplete="off"autofill="off">
<input autocomplete="false" name="hidden" type="text" style="display:none;">
    
<input type="number" class="form-control"name="phone" placeholder="Phone no" required>
<input type="password" class="form-control"name="password" placeholder="Password" required>
<div class="row">
  <div class="col text-center">
   <input class="btn btn-outline-success p-1"  type="submit" value="Login">
  </div>
</div>

   </form>
   <div class="row">
<div class="col text-center link ">
<a class="btn btn-outline-info" href="signup.php">Create Account </a>
</div>
<div class="col text-center link "> 
<a class="btn btn-outline-warning " href="reset.php">Reset Password</a>

</div>
</div>
<div id="h2" class="text-center">This site is designed and maintened by <a href="https://facebook.com/ TheShubhendra">Shubhendra Kushwaha</a></div>
</div>
</body>

 </html>
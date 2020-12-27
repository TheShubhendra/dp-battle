<?php
require'dbConnect.php';
session_start();
    if ($_SESSION["loggedIn"]){
        header("location: index.php");
        mysqli_close($conn);
        exit();
    }
    if (isset($_COOKIE["id"]) && isset($_COOKIE["token"])){
        header("location: login.php");
        mysqli_close($conn);
       exit();
    }
    if ($_SERVER["REQUEST_METHOD"]=="POST"){
    $name = $_POST["name"];
    $gender = $_POST["gender"];
    $phone = $_POST["phone"];
    $email = $_POST["email"];
    $password = $_POST["password"];
    $result = $conn->query("SELECT id FROM userData WHERE phone = $phone");
    if ($result->num_rows >0){
    echo '<div class="error  alert alert-warning alert-dismissible">
  <button type="button" class="close" data-dismiss="alert">&times;</button>
  <strong>SignUpError!</strong> Phone no. already registered
</div>';
    }else{
$result = $conn->query("SELECT id FROM userData WHERE email = '$email'");
    if ($result->num_rows >0){
    echo '<div class="error  alert alert-warning alert-dismissible">
  <button type="button" class="close" data-dismiss="alert">&times;</button>
  <strong>SignUp Error!</strong> Email already registered
</div>';
    }else{
  $result= $conn->query("INSERT INTO `userData` (name,gender, phone, email) VALUES ('$name', '$gender' , '$phone','$email')");
    $result = $conn->query("SELECT id FROM userData WHERE phone = $phone;");
    $row = $result->fetch_assoc();
    $id = $row["id"];
    $_SESSION["id"] = $id;
    $_SESSION["name"] = $name;
    $_SESSION["loggedIn"] = true;
    $token = bin2hex(openssl_random_pseudo_bytes(16));
    $conn->query("INSERT INTO `loginData` (id,password,token) VALUES('$id','$password','$token')");
    setcookie("id",$id,time()+365*24*60*60);
    setcookie("token",$token,time()+365*24*60*60,"/");
    mysqli_close($conn);
    if(isset($_SESSION["ref"])){
header("location: ".$_SESSION["ref"]);
        }else{
header("location: index.php");
        }
        
    exit();
    }
    }
    }
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
.blackbox{
  margin-top:10%;
  width: 80%;
  background: #111111;
  border-radius:3%;
}
.blackbox .h1{
  color: #f8881df1;
font-family: 'Poor Story', cursive;
}
label{
  color: #93dbed;
}
.error{
     position: fixed;
     z-index: 0;
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

	<div id="form" class="container p-3  blackbox">
	<div class="h1 text-center display-2">Sign up</div>
	<form target ="" method="POST" autofill="true"autocomplete="off"autofill="off">
<input autocomplete="false" name="hidden" type="text" style="display:none;">
 <div class="form-group">
   <label for="name">Name</label>
   <input type="text/submit/hidden/button" name="name" id="name" class="form-control" placeholder="Enter Your Name" required/>
 </div>
<div class="form-group">
  <label for="phone">Phone</label>
  <input type="text/submit/hidden/button" name="phone" id="phone" class="form-control" placeholder="Enter your Phone number" maxlength="10" minlength="10" required/>
</div>
<div class="form-group">
  <label for="gender">Gender</label>
  <br>
  <select name="gender" id="gender">
    <option value="male">Male</option>
    <option value="female">Female</option>
    <option value="other">Other</option>
  </select>
</div>
<div class="form-group">
   <label for="email">Email</label>
   <input type="email" name="email" id="email" class="form-control" placeholder="Enter Your Email address" />
 </div>
<div class="form-group">
  <label for="password">Create Password</label>
  <input type="text/submit/hidden/button" name="password" id="password" class="form-control" placeholder="Create a password" required/>
</div>
   <div class="row m-3 ">
<div class="col text-center ">
<a class="btn btn-outline-info p-0" href="login.php">Back to Login </a>
</div>
<div class="col text-center  "> 
<button type="submit" class="btn btn-outline-success p-0" >Create Account</button>
</div>
</div>
</form>
</div>
</body>

 </html>
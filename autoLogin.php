<?php
session_start();
require("dbConnect.php");
if($_SESSION["loggedIn"]){
  header("location : index.php");
  exit();
}
if (isset($_COOKIE["id"]) && isset($_COOKIE["token"])){
        $id = $_COOKIE["id"];
        $token = $_COOKIE["token"];
       $result = $conn->query("SELECT token FROM loginData WHERE id = $id;");
        $row = $result->fetch_assoc();
        if ($row["token"] == $token){
          
        
        $sql = "SELECT name FROM userData where id = $id";
       $result =  $conn->query($sql);
      
       $row = $result-> fetch_assoc();
        $_SESSION["id"] = $id;
        $_SESSION["name"] = $row["name"];
        $_SESSION["loggedIn"] = true;
        mysqli_close($conn);
        if(isset($_SESSION["ref"])){
header("location: ".$_SESSION["ref"]);
        }else{
header("location: index.php");
        }
        
        exit();
    }else{
      header("location: logout.php");
      exit();
    }
  
}else{
      header("location: login.php");
      exit();
    }
    ?>
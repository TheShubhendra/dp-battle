<?php
session_start();
if(!isset($_SESSION["loggedIn"])){
  header("location: autoLogin.php");
  exit()
}
if ($_SERVER["REQUEST_METHOD"]=="POST"){
  $name1 = $_POST["name1"];
$name2 = $_POST["name2"];
$file_name1 = time().'_'.$_FILES['file1']['name'];
      $file_tmp1 = $_FILES['file1']['tmp_name'];
move_uploaded_file($file_tmp1,"images/".$file_name1);
$file_name2 = time().'_'.$_FILES['file2']['name'];
$file_tmp2 = $_FILES['file2']['tmp_name'];
   $id = $_SESSION["id"];
move_uploaded_file($file_tmp2,"images/".$file_name2);
$dur = $_POST["time"];
$start = date("y-m-d H:m:s");
$end = date("y-m-d H:m:s", strtotime($start)+($dur*3600));
require "dbConnect.php";
$sql = "INSERT INTO `battleData` (name1,name2, image1, image2,user,time,start,end) VALUES('$name1' ,'$name2' , '$file_name1', '$file_name2' ,'$id', '$dur','$start','$end') ";
echo $_FILES["file2"];
echo $sql;
$result = $conn->query($sql);
  mysqli_close($conn);
}







?>


<!DOCTYPE html>
<html>
<head>
  <meta http-equiv="content-type" content="text/html; charset=utf-8" />
      
  <meta name="theme-color" content="#e26c11e6">
        <meta name="viewport" content="width=device-width,initial-scale=1.0">
<link href="https://fonts.googleapis.com/css?family=Dancing+Script|Nunito|Pacifico|Poor+Story|Shadows+Into+Light&display=swap" rel="stylesheet">
<link href="https://fonts.googleapis.com/css2?family=Metal+Mania&display=swap" rel="stylesheet">


<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"></script>
  <title>Create Battle</title>
  <style>
   .frame{
      margin: 5px 0px;
      background-color: #dddddd;
      width:170px;
      height: 340px;
      padding: 2px;
      text-align: center;
      border-width: 1px;
      border-style:solid;
      border-color:#bae7f3;
    }
    img{
      max-height: 100%;
      min-height: 80%;
      width: 100%;
      height:100%;
    }
   #text1 ,#text2{
      color:hotpink;
      display: block;
      margin :135px 0px;
      font-family: courier;
    }
 

  </style>
</head>
<body>
<?php
include("header.php");
?>
  <form action="" method="post" accept-charset="utf-8" enctype="multipart/form-data" >
  <div class ="container">
    <div class="row">
      <div class="col frame m-1 "onclick="upload(1)">
      <img id="p1" src="" alt="preview 1" hidden/>
      <span id="text1">Click here to select Image</span>
        <input type="file" name="file1" id="img1" value="" alllow="images/*" onchange="show(1)" hidden/>
      </div>
      <div class="col frame m-1" onclick="upload(2)">
        <img id="p2" src="" alt="preview2" hidden/>
        <span id="text2">Click here to select Image</span>
       <input type="file" name="file2" id="img2" onchange="show(2)" hidden>
      </div>
    </div>
    <div class="row">
      <div class="col">
        <input class="form-control" type="text" name="name1" id="name1" placeholder="Name of First Participant" />
      </div>
      <div class="col">
        <input type="text" class="form-control"name="name2" id="name2" placeholder="Name of 2nd Participant" />
      </div>
    </div>
    <div class="row">
      
     <div class="col">
      <div class="form-group">
        
     <label for="time">Select Battle Duration</label>
 
      <select name="time" id="time" class="form-control">
        <option value="1">1hr</option>
     <option value="12">12hr</option>
     <option value="24">24hr</option>
     <option value="48">48hr</option>
     </select>
        </div>
      </div>
      </div>
      <div class="row">
        <div class="col text-center">
          <input type="submit" class="btn btn-success"  id="submit" value="Create Battle" />
        </div>
      </div>
    
  </div>

   
   </form>

 
  
   <script>
     function upload(x){
       document.getElementById("img"+x).click();
      
     }
     function show(x){
      const img = document.getElementById("img"+x).files[0];
      const pre = document.getElementById("p"+x);
      if(img){
        var reader = new FileReader();
        reader.addEventListener("load",function(){
          document.getElementById("text"+x).innerHTML="";
          pre.src = this.result;
          pre.hidden=false;
        });
        reader.readAsDataURL(img);
      }
     }
   </script>
</body>
</html>
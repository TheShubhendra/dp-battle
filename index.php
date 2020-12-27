<?php
session_start();
if(!isset($_SESSION["loggedIn"])){
header("location: autoLogin.php");
    exit();
}
include("func.php");
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
          
          img{
       max-width:100%;
       
          }
          
          .name{
            font-size: 90%;
            font-family: Verdana;
            text-align: center;
          }
          .container{
            border: 2px solid green;
            background-color:#b7e1a3cd;
            width:98%;
          }
          
        </style>
    </head>
    <body>
      

        <?php
     
        require"dbConnect.php";
        include("header.php");
      
       $result = $conn->query("SELECT id,name1,name2,image1,image2 FROM battleData;");
       
       while($row = $result->fetch_assoc()){
    printf('
    <div class="container text-center  rounded mt-3 p-3">
      <div class="row">
        <div class="col text-center id"> <a href="viewbattle.php?id=%s">Battle No.: %s </a></div>
      </div>
      <div class="row">
        <div class="col">
          <img src="images/%s" alt="image1" />
        </div>
        <div class="col">
          <img src="images/%s" alt="" />
        </div>
      </div>
      <div class="row">
        <div class="col name">
          %s
        </div>
        <div class="col name">
          %s
        </div>
      </div>
      <div class="row ">
        <div class="col text-center">
        <div class="btn %s btn-block" data-bid="%s" data-part="A">
        %s vote
        </div>
        </div>
        <div class="col text-center">
          <div class="btn %s btn-block" data-bid="%s" data-part="B">
            %s vote
          </div>
        </div>
      </div>
    </div>
    </div>
   
    
    ',$row["id"],$row["id"],$row["image1"],$row["image2"],$row["name1"],$row["name2"],getClass($row["id"],'A'),$row["id"],getVotes($row["id"],'A'),getClass($row["id"],'B'),$row["id"],getVotes($row['id'],'B'));
           
       }
       echo getUser(25);
        ?>
  

<script src="script.js" type="text/javascript"></script>
    </body>
    <?php mysqli_close($conn); ?>
</html>
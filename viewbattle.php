<?php
session_start();
$_SESSION["ref"] = $_SERVER["REQUEST_URI"];

if(!isset($_SESSION["loggedIn"])){
  header("location: autoLogin.php");
}
require("dbConnect.php");
require("func.php");
echo '<html>
<head>

  <meta name="theme-color" content="#e26c11e6">
        <meta name="viewport" content="width=device-width,initial-scale=1.0">
<link href="https://fonts.googleapis.com/css?family=Dancing+Script|Nunito|Pacifico|Poor+Story|Shadows+Into+Light&display=swap" rel="stylesheet">
<link href="https://fonts.googleapis.com/css2?family=Metal+Mania&display=swap" rel="stylesheet">


<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"></script>

  
  
  
  
  
 </head>' ;
 echo "<body>";
include("header.php");
if(isset($_GET["id"])){
  
  $id = $_GET["id"];
       $result = $conn->query("SELECT id,name1,name2,image1,image2 FROM battleData WHERE id = $id;");
       if (mysqli_num_rows($result) == 1){
       
       $row = $result->fetch_assoc();
    printf('
      
        <style>
          
          img{
       max-width:100%%;
       
          }
          
          .name{
            font-size: 90%%;
            font-family: Verdana;
            text-align: center;
          }
          .container{
            border: 2px solid green;
            background-color:#b7e1a3cd;
            width:98%%;
          }
          
        </style>
      
       
    <div class="container text-center  rounded mt-3 p-3">
      <div class="row">
        <div class="col text-center id"> <a href="viewbattle.php?id=%s">Battle No.: %d </a></div>
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
        <div class="btn %s btn-block" data-bid="%d" data-part="A">
         %s vote
        </div>
        </div>
        <div class="col text-center">
          <div class="btn %s btn-block"  data-bid="%d" data-part="B">
             %s vote
          </div>
        </div>
      </div>
    </div>
    </div>
    
    
    
  
  <script src="script.js" type="text/javascript">

  </script>
    
   </body>
   </html>
    
    ',$row["id"],$row["id"],$row["image1"],$row["image2"],$row["name1"],$row["name2"],getClass($row["id"],'A'),$row["id"],getVotes($row["id"],'A'),getClass($row["id"],'B'),$row["id"],getVotes($row["id"],'B'));
           
}else{
  echo '
  
  <div class="alert alert-warning alert-dismisibble">
  
  <button type="button" class="close" data-dismiss="alert">&times;</button>
  Battle not found 
  </div>
  
 <div class="container mt-4">
  <form method="get" action="" >
  <div class="form-group">
  <label for="id">Enter Battle Id</label>
  <input type="number" name="id" id="id" value="" required>
  </div>
  <div class="form-group text-center">
  <input type="submit" class="btn btn-outline-success " value="View Battle" >

  </div>
  </div>
  </form>
  </body>
  
  </html>
  
  
  
  ';
}

}else{
 echo'
 
 <div class="container mt-4">
  <form method="get" action="" >
  <div class="form-group">
  <label for="id">Enter Battle Id</label>
  <input type="number" name="id" id="id" value="" required>
  </div>
  <div class="form-group text-center">
  <input type="submit" class="btn btn-outline-success " value="View Battle">
  </form>
  </div>
  </div>
  </body>
  </html>';
}





mysqli_close($conn);


?>
      
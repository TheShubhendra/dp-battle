<?
session_start();
require("dbConnect.php");
if (!$_SESSION['loggedIn']){
  header("location : login.php");
  exit();
}
if ($_SERVER["REQUEST_METHOD"] == "POST"){
 
  $battleId = $_POST['battleId']; 
  $votedTo = $_POST['votedFor'];
  $userId = $_SESSION["id"];
  
  
$sql = "INSERT INTO votingData (battleId, votedTo,userId) VALUES ($battleId,'$votedTo',$userId) ON DUPLICATE KEY UPDATE battleId = $battleId";
  
$conn->query($sql);
  
  
  if ($votedTo == 'A'){
$sql = "DELETE FROM votingData WHERE userId = $userId AND battleId = $battleId AND votedTo = 'B' ";
$sql1 = "SELECT COUNT(*) FROM votingData WHERE battleId = $battleId AND votedTo = 'A' ";
    
$sql2 = "SELECT COUNT(*) FROM votingData WHERE battleId = $battleId AND votedTo = 'B' ";
    
  }elseif ($votedTo == 'B') {
    
    
$sql = "DELETE FROM votingData WHERE userId = $userId AND battleId = $battleId AND votedTo = 'A' ";
    
    
$sql1 = "SELECT COUNT(*) FROM votingData WHERE battleId = $battleId AND votedTo = 'B' ";
    
$sql2 = "SELECT COUNT(*) FROM votingData WHERE battleId = $battleId AND votedTo = 'A' ";
    
    
    
  }
$conn->query($sql);

$result = $conn->query($sql1);
$side = $result->fetch_array();

$result = $conn->query($sql2);
$opponent = $result->fetch_array();

 $arr = array(
   "side" => $side[0],
   "oppo"=> $opponent[0]
   ) ;
   $data = json_encode($arr);
echo $data;

  mysqli_close($conn);

}
?>
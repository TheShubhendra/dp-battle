<?php

  function getVotes($post_id,$votedTo){
    global $conn;
  $sql = "SELECT COUNT(*) FROM votingData WHERE votedTo = '$votedTo' AND battleId = $post_id";
  
     $result = $conn->query($sql);
    $row =  $result->fetch_array();
    return $row[0];
  }
  function isVoted($battle_id,$votedTo){
    global $conn;
    $userId = $_SESSION["id"];
      $result = $conn->query("SELECT COUNT(*) FROM votingData WHERE userId = $userId AND battleId = $battle_id AND votedTo = '$votedTo'");
      
      
      if($result->fetch_array()[0]>0){
        return 1;
      }else{
        return 0;
      }
   
  }
  
  
  
  function getClass($battle_id,$votedTo){
 
   if($votedTo=='A'){
     $oppo = 'B';
   }elseif($votedTo == 'B'){
     $oppo = 'A';
   }
    if(isVoted($battle_id,$votedTo)){
      return "btn-success";
    }elseif(isVoted($battle_id,$oppo)){
      return "btn-info";
    }else{
      return "btn-primary";
    
  }
  }
  function getUser($battle_id){
  $result = $conn->query("SELECT user FROM battleData WHERE id=$battle_id ");
   $row=$result->fetch_assoc();
   $userId = $row["user"];
   $result= $conn->query("SELECT name FROM userData WHERE id = $userId");
   $row = $result->fetch_assoc();
   return $row["name"];
  }
?>
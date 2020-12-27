  $(document).ready(function(){
    $(".btn").on("click",function(){
     btn = $(this);
     battleId = $(this).data("bid");
     votedFor = $(this).data("part");
    $.post("vote.php",{
       "battleId":battleId,
       "votedFor":votedFor
     },function(response){
 var obj = JSON.parse(response);
btn.removeClass("btn-info");
btn.addClass("btn-success");
btn[0].innerHTML = obj.side + " vote";
btn.parent().siblings().children().removeClass("btn-success");
btn.parent().siblings().children().addClass("btn-info");
btn.parent().siblings().children()[0].innerHTML= obj.oppo + " vote";
     });
    });
  });
  
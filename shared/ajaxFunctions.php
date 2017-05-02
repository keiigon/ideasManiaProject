<?php
    include("database.php");
    if(isset($_POST["action"]) && !empty($_POST["action"])){
        $action = $_POST["action"];
        
        switch($action){
            case "AddComment":
                AddComment($_POST["ideaId"], $_POST["userId"], $_POST["comment"]);
                break;
            case "AddRate":
                AddRate($_POST["ideaId"], $_POST["userId"], $_POST["rate"]);
                break;
            default:
        }
    }

function AddComment($ideaId, $userId, $comment){
    $currentDate = date('Y-m-d');
    
    $query = "insert into comments (Comment, User_Id, Idea_Id, Date)
              values ('$comment', $userId, $ideaId, '$currentDate')";
    
    $result = RunQuery($query);
    
    return $result;
}

function AddRate($ideaId, $userId, $rate){
    $query = "insert into rating (User_Id, Idea_Id, RatingValue)
              values ($userId, $ideaId, $rate)";
    
    $result = RunQuery($query);
    
    return $result;
}

?>
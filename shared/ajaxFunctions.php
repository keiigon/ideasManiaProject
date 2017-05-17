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
            case "DeleteIdea":
            DeleteIdea($_POST["ideaId"]);
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
    $query = "select RatingValue from rating where Idea_Id = $ideaId and User_Id = $userId";
    
    $result = RunQuery($query);
    
    $row = mysqli_fetch_array($result);
    
    $rating = $row["RatingValue"];
    
    if(empty($rating)){
        $query = "insert into rating (User_Id, Idea_Id, RatingValue)
                  values ($userId, $ideaId, $rate)";
    
        $result = RunQuery($query);
    
        return $result;
    }
    else{
        $query = "update rating set RatingValue = $rate where Idea_Id = $ideaId and User_Id = $userId";
    
        $result = RunQuery($query);
    
        return $result;
    }
}

function DeleteIdea($ideaId){
    $query = "delete from ideas where Idea_Id = $ideaId";
    
    $result = RunQuery($query);
    
    return $result;
}

?>
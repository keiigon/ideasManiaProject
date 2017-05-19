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
            case "GetTotalLikes":
                GetTotalLikes($_POST["ideaId"]);
                break;
            case "DeleteCategory":
                DeleteCategory($_POST["categoryId"]);
                break;
            case "AddNewCategory":
                AddNewCategory($_POST["title"]);
                break;
            case "UpdateCategory":
                UpdateCategory($_POST["title"], $_POST["categoryId"]);
                break;
            case "GetUser":
                GetUser($_POST["adminId"]);
                break;
            case "AddNewUser":
                AddNewUser($_POST["username"], $_POST["password"], $_POST["isSuperAdmin"]);
                break;
            case "UpdateUser":
                UpdateUser($_POST["username"], $_POST["password"], $_POST["isSuperAdmin"], $_POST["adminId"]);
                break;
            case "DeleteUser":
                DeleteUser($_POST["adminId"]);
                break;
            case "DeleteMember":
                DeleteMember($_POST["memberId"]);
                break;
            case "DeleteComment":
                DeleteComment($_POST["commentId"]);
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
    
    if($rating == ""){
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

function GetTotalLikes($ideaId){
    $query = "select sum(RatingValue) as totalRating from rating where Idea_Id = $ideaId group by Idea_Id";
    
    $result = RunQuery($query);
    
    $row = mysqli_fetch_array($result);
    
    $rating = $row["totalRating"];
    
    echo $rating;
}

function DeleteCategory($categoryId){
    $query = "delete from category where Category_Id = $categoryId";
    
    $result = RunQuery($query);
    
    $query = "select Idea_Id from ideas where Category_Id = $categoryId";
    
    $result = RunQuery($query);
    
    while($row = mysqli_fetch_array($result)){
        $query = "update ideas set Category_Id = 3 where Idea_Id = " . $row['Idea_Id'];
        
        $result2 = RunQuery($query);
    }
    
    return $result;
}

function AddNewCategory($title){
    $query = "insert into category (Title)
              values ('$title')";
    
    $result = RunQuery($query);
    
    return $result;
}

function UpdateCategory($title, $categoryId){
    $query = "update category set Title = '$title' where Category_Id = $categoryId";
    
    $result = RunQuery($query);
    
    return $result;
}

function GetUser($adminId){
    $query = "select * from admins where Admin_Id = $adminId";
    
    $result = RunQuery($query);
    
    $row = mysqli_fetch_array($result);
    
    $item = (object)array();
    $item->id = $row["Admin_Id"];
    $item->username = $row["Username"];
    $item->password = $row["Password"];
    $item->isSuperAdmin = $row["IsSuperAdmin"];
    
    echo json_encode($item);
}

function AddNewUser($username, $password, $isSuperAdmin){
    $query = "insert into admins (Username, Password, IsSuperAdmin)
              values ('$username', '$password', $isSuperAdmin)";
    
    $result = RunQuery($query);
    
    return $result;
}

function UpdateUser($username, $password, $isSuperAdmin, $adminId){
    $query = "update admins set Username = '$username', Password = '$password', IsSuperAdmin = $isSuperAdmin where Admin_Id = $adminId";
    
    $result = RunQuery($query);
    
    return $result;
}

function DeleteUser($adminId){
    $query = "delete from admins where Admin_Id = $adminId";
    
    $result = RunQuery($query);
    
    return $result;
}

function DeleteMember($memberId){
    $query = "delete from users where User_Id = $memberId";
    $result = RunQuery($query);
    
    $query = "delete from ideas where User_Id = $memberId";
    $result = RunQuery($query);
    
    $query = "delete from comments where User_Id = $memberId";
    $result = RunQuery($query);
    
    $query = "delete from rating where User_Id = $memberId";
    $result = RunQuery($query);
    
    return $result;
}

function DeleteComment($commentId){
    $query = "delete from comments where Comment_Id = $commentId";
    $result = RunQuery($query);
    return $result;
}

?>
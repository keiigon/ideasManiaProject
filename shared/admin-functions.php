<?php

include("database.php");

function Login($username, $password){
    $query = "select Admin_Id, Username, IsSuperAdmin from admins
              where Username = '$username' and Password = '$password'";
    
    $result = RunQuery($query);
    
    $row = mysqli_fetch_array($result);
    
    $user = (object)array();
    $user->userId = $row["Admin_Id"];
    $user->username = $row["Username"];
    $user->isSuperAdmin = $row["IsSuperAdmin"];
    
    return $user;
}

function GetAllIdeas(){
    $query = "select i.Idea_Id, i.Title, i.Date, c.Title as category, 
             (select sum(r.RatingValue) from rating as r inner join ideas as d on r.Idea_Id = d.Idea_Id where d.Idea_Id = i.Idea_Id group  by r.Idea_Id) as rating from ideas as i 
             inner join category as c 
             on i.Category_Id = c.Category_Id
             order by i.Date desc";
    
    $result = RunQuery($query);
    
    $ideasList = array();
    
    while ($row = mysqli_fetch_array($result))
    {
        $idea = (object)array();
        $idea->ideaId = $row["Idea_Id"];
        $idea->title = $row["Title"];
        $idea->category = $row["category"];
        $idea->postDate = $row["Date"];
        $idea->rating = $row["rating"];
        
        array_push($ideasList, $idea);
    }
    
    return $ideasList;
}

function GetCategories(){
    $query = "select * from category";
    
    $result = RunQuery($query);
    
    $categoryList = array();
    
    while($row = mysqli_fetch_array($result)){
        $category = (object)array();
        $category->id = $row["Category_Id"];
        $category->title = $row["Title"];
        
        array_push($categoryList, $category);
    }
    
    return $categoryList;
}

function GetAllUsers(){
    $query = "select * from admins";
    
    $result = RunQuery($query);
    
    $dataList = array();
    
    while($row = mysqli_fetch_array($result)){
        $item = (object)array();
        $item->id = $row["Admin_Id"];
        $item->username = $row["Username"];
        $item->isSuperAdmin = $row["IsSuperAdmin"];
        
        array_push($dataList, $item);
    }
    
    return $dataList;
}

function GetAllMembers(){
    $query = "select u.User_Id, u.FirstName, u.LastName, u.Username, u.Email, u.Gender, u.JoinedDate, u.PhotoPath, c.Title as Country from          users as u inner join country as c on u.Country_Id = c.Country_Id";
    
    $result = RunQuery($query);
    
    $dataList = array();
    
    while($row = mysqli_fetch_array($result)){
        $item = (object)array();
        $item->id = $row["User_Id"];
        $item->name = $row["FirstName"] . " " . $row["LastName"];
        $item->username = $row["Username"];
        $item->email = $row["Email"];
        $item->gender = $row["Gender"];
        $item->country = $row["Country"];
        $item->photo = $row["PhotoPath"];
        $item->joinedDate = $row["JoinedDate"];
        
        array_push($dataList, $item);
    }
    
    return $dataList;
}

function GetIdeaComments($ideaId){
    $query = "select c.Comment_Id, c.Comment, c.Date, u.Username from comments as c 
              inner join users as u 
              on c.User_Id = u.User_Id
              where c.Idea_Id = $ideaId";
    
    $result = RunQuery($query);
    
    $commentsList = array();
    
    while ($row = mysqli_fetch_array($result))
    {
        $comment = (object)array();
        $comment->id = $row["Comment_Id"];
        $comment->comment = $row["Comment"];
        $comment->postedDate = $row["Date"];
        $comment->username = $row["Username"];
        
        array_push($commentsList, $comment);
    }
    
    return $commentsList;
}

function GetIdeaTitle($ideaId){
    $query = "select Title from ideas where Idea_Id = $ideaId";
    
    $result = Runquery($query);
    
    $row = mysqli_fetch_array($result);
    
    return $row["Title"];
}

?>
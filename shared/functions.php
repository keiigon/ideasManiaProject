<?php

include("database.php");

function GetLastIdeas($numberOfIdeas){
    $limit = $numberOfIdeas == 0 ? '' : ' limit '.$numberOfIdeas;
    
    $query = "select i.Idea_Id, i.Title, i.Description, i.Date, u.Username from ideas as i 
              inner join users as u 
              on i.User_Id = u.User_Id 
              order by Date desc" . $limit;
    
    $result = RunQuery($query);
    
    $ideasList = array();
    
    while ($row = mysqli_fetch_array($result))
    {
        $idea = (object)array();
        $idea->ideaId = $row["Idea_Id"];
        $idea->title = $row["Title"];
        $idea->description = $row["Description"];
        $idea->postDate = $row["Date"];
        $idea->username = $row["Username"];
        
        array_push($ideasList, $idea);
    }
    
    return $ideasList;
}

function Login($username, $password){
    $query = "select User_Id, Username from users
              where Username = '$username' and Password = '$password'";
    
    $result = RunQuery($query);
    
    $row = mysqli_fetch_array($result);
    
    $user = (object)array();
    $user->userId = $row["User_Id"];
    $user->username = $row["Username"];
    
    return $user;
}

?>
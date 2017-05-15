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

function GetCountries(){
    $query = "select * from country";
    
    $result = RunQuery($query);
    
    $countryList = array();
    
    while($row = mysqli_fetch_array($result)){
        $country = (object)array();
        $country->id = $row["Country_Id"];
        $country->title = $row["Title"];
        
        array_push($countryList, $country);
    }
    
    return $countryList;
}

function CheckUser($email, $username, $userId){
    $query = "select User_Id from users where (Email = '$email' or Username = '$username') and User_Id != $userId";
    
    $result = RunQuery($query);
    
    $row = mysqli_fetch_array($result);
    
    return $row["User_Id"];
}

function Register($firstname, $lastname, $username, $password, $email, $gender, $country, $photo){
    $currentDate = date('Y-m-d');
    
    $query = "insert into users (FirstName, LastName, Username, Password, Email, Gender, Country_Id, PhotoPath, JoinedDate)
              values ('$firstname', '$lastname', '$username', '$password', '$email', $gender, $country, '$photo', '$currentDate')";
    
    $result = RunQuery($query);
    
    return $result;
}

function GetUserProfile($userId){
    $query = "select u.FirstName, u.LastName, u.Username, u.Password, u.Email, u.Gender, u.JoinedDate, u.PhotoPath, u.Country_Id, c.Title from users as u
              inner join country as c on u.Country_Id = c.Country_Id
              where u.User_Id = $userId";
    
    $result = RunQuery($query);
    
    $row = mysqli_fetch_array($result);
    
    $user = (object)array();
    $user->name = $row["FirstName"] . " " . $row["LastName"];
    $user->firstname = $row["FirstName"];
    $user->lastname = $row["LastName"];
    $user->username = $row["Username"];
    $user->password = $row["Password"];
    $user->email = $row["Email"];
    $user->gender = $row["Gender"] == 1 ? "Male" : "Female";
    $user->country = $row["Title"];
    $user->countryId = $row["Country_Id"];
    $user->joinedDate = $row["JoinedDate"];
    $user->photo = $row["PhotoPath"];
    
    return $user;
}

function UpdateUserProfile($firstname, $lastname, $username, $password, $email, $gender, $country, $photo, $userId){
    $query = "update users set FirstName = '$firstname', LastName = '$lastname', Username = '$username', Password = '$password', Email = '$email', Gender = $gender, Country_Id = $country, PhotoPath = '$photo' where User_Id = $userId";
    
    $result = RunQuery($query);
    
    return $result;
}

function GetUserIdeas($userId){
    $query = "select i.Idea_Id, i.Title, i.Date, c.Title as category from ideas as i 
              inner join category as c 
              on i.Category_Id = c.Category_Id
              where i.User_Id = $userId
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

function AddNewIdea($title, $description, $categoryId, $content, $userId){
    $currentDate = date('Y-m-d');
    
    $query = "insert into ideas (Title, Description, Content, User_Id, Category_Id, Date)
              values ('$title', '$description', '$content', $userId, $categoryId, '$currentDate')";
    
    $result = RunQuery($query);
    
    return $result;
}

function GetIdeasByCategory($categoryId){
    $where = $categoryId == 0 ? '' : ' where i.Category_Id = '.$categoryId;
    
    $query = "select i.Idea_Id, i.Title, i.Description, i.Date, u.Username, c.Title as categoryTitle from ideas as i 
              inner join users as u 
              on i.User_Id = u.User_Id
              inner join category c
              on i.Category_Id = c.Category_Id" . $where . " order by Date desc";
    
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
        $idea->category = $row["categoryTitle"];
        
        array_push($ideasList, $idea);
    }
    
    return $ideasList;
}

function GetIdeaById($ideaId){
    $query = "select i.Idea_Id, i.Title, i.Description, i.Date, i.Content, i.Category_Id as catId, i.User_Id as userId, u.Username, c.Title as categoryTitle from ideas as i 
              inner join users as u 
              on i.User_Id = u.User_Id
              inner join category c
              on i.Category_Id = c.Category_Id where i.Idea_Id = $ideaId";
    
    $result = RunQuery($query);
    
    $row = mysqli_fetch_array($result);
    
    $idea = (object)array();
    $idea->ideaId = $row["Idea_Id"];
    $idea->title = $row["Title"];
    $idea->description = $row["Description"];
    $idea->content = $row["Content"];
    $idea->postDate = $row["Date"];
    $idea->username = $row["Username"];
    $idea->category = $row["categoryTitle"];
    $idea->userId = $row["userId"];
    $idea->categoryId = $row["catId"];
    
    return $idea;
}

function GetIdeaComments($ideaId){
    $query = "select c.Comment, c.Date, u.Username, u.PhotoPath from comments as c 
              inner join users as u 
              on c.User_Id = u.User_Id
              where c.Idea_Id = $ideaId";
    
    $result = RunQuery($query);
    
    $commentsList = array();
    
    while ($row = mysqli_fetch_array($result))
    {
        $comment = (object)array();
        $comment->comment = $row["Comment"];
        $comment->postedDate = $row["Date"];
        $comment->username = $row["Username"];
        $comment->photo = $row["PhotoPath"];
        
        array_push($commentsList, $comment);
    }
    
    return $commentsList;
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

function CheckUserRating($ideaId, $userId){
    $query = "select RatingValue from rating where Idea_Id = $ideaId and User_Id = $userId";
    
    $result = RunQuery($query);
    
    $row = mysqli_fetch_array($result);
    
    return $row["RatingValue"];
}

function UpdateIdea($title, $description, $categoryId, $content, $ideaId){
    $query = "update ideas set Title = '$title', Description = '$description', Category_Id = $categoryId, Content = '$content' where Idea_Id = $ideaId";
    
    $result = RunQuery($query);
    
    return $result;
}


?>
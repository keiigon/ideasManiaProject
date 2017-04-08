<?php

function RunQuery($query){
    $con = mysqli_connect("localhost","root","", "ideasmania") or die ("can not establish connection");

    $result = mysqli_query($con, $query);

    mysqli_close($con);
    
    return $result;
}


?>
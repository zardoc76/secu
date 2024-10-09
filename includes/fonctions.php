<?php

function getnews() 
{
    global $conn;

    $sql = "SELECT * FROM news";
    $result = mysqli_query($conn, $sql);

    return $result;
}




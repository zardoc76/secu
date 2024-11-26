<?php

function getnews() 
{
    global $conn;

    $sql = "SELECT * FROM news";
    $result = mysqli_query($conn, $sql);

    return $result;
}

function getUsers() 
{
    global $conn;

    $sql = "SELECT * FROM utilisateur";
    $result = mysqli_query($conn, $sql);

    return $result;
}

function deleteUser($id) 
{
    global $conn;

    $sql = "DELETE FROM utilisateur WHERE id = $id";

    return mysqli_query($conn, $sql);
}


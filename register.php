<!DOCTYPE html>
<?php include('config.php'); ?>
<?php
$username = "";
$errors = array();

// LOG USER IN
if (isset($_POST['login_btn'])) {
    $username = esc($_POST['username']);
    $password = esc($_POST['password']);
    
    if (empty($username)) {
        array_push($errors, "Username required");
    }

    if (empty($password)) {
        array_push($errors, "Password required");
    }

    if (empty($errors)) {
        $password = md5($password); // encrypt password
         
        $sql = "SELECT * FROM utilisateur WHERE username='$username' and password='$password' LIMIT 1";
        $result = mysqli_query($conn, $sql);
        
        if (mysqli_num_rows($result) > 0) {
            // get id of created user
            $reg_user_id = mysqli_fetch_assoc($result)['id'];
            //var_dump(getUserById($reg_user_id)); die();
            // put logged in user into session array
            $_SESSION['user'] = getUserById($reg_user_id);

            // if user is admin, redirect to admin area
            if (in_array($_SESSION['user']['role'], ["admin"])) {
                $_SESSION['message'] = "You are now logged in";
                // redirect to admin area
                header('location: ' . BASE_URL . '/admin/dashboard.php');
                exit(0);
            } else {
                $_SESSION['message'] = "You are now logged in";
                // redirect to public area
                header('location: index.php');
                exit(0);
            }
        } else {
            array_push($errors, 'Wrong credentials');
        }
    }
}

if(isset($_POST['reg_btn'])){
    
     
    $username = esc($_POST['username']);
    $firstname = esc($_POST['firstname']);
    $lastname = esc($_POST['lastname']);
    $password = esc($_POST['password']);
    

    if(empty($username)){
        array_push($errors, "Username required");
    }
    if(empty($firstname)){
        array_push($errors, "First Name required");
    }
    if(empty($lastname)){
        array_push($errors, "Last Name required");
    }
    if(empty($password)){
        array_push($errors, "Password required");
    }
    if(empty($errors)){
        
        $sql = "SELECT * FROM utilisateur WHERE username='$username'  LIMIT 1";
        $result = mysqli_query($conn, $sql);
         
        if (!$result) {
            die("Query failed: " . mysqli_error($conn));
        }
        
        $user = mysqli_fetch_assoc($result);
         
        if($user) {
            if ($user['username'] === $username) {
                array_push($errors, "Username already exists");
            }
        }
       else{
        $password = md5($password); //encrypt password
        $sql = "INSERT INTO utilisateur (username, password,nom,prenom,role,solde , abonne) VALUES('$username', '$password','$firstname','$lastname','user', 0, 0)";
        mysqli_query($conn, $sql);
        
        $_SESSION['user']=getUserById(mysqli_insert_id($conn)); // put logged in user into session array
        
        if(in_array($_SESSION['user']['role'], ["user"])){
            $_SESSION['message'] = "vous êtes inscrit!";
            // redirect to users area
            header('location: index.php');
            exit(0);
        }
        if(in_array($_SESSION['user']['role'] ,["admin"]))
        {
            $_SESSION['message'] = "vous êtes inscrit!";
            // redirect to admin area
            header('location: ' . BASE_URL . '/admin/dashboard.php');
            exit(0);
        }
    }      
}
}

function esc(String $value) 
{ 
    //à compléter ultérieurement 
    $val = trim($value); // remove empty space sorrounding string 
    return $val; 
} 

function getUserById($id)
{
 global $conn; //rendre disponible, à cette fonction, la variable de connexion $conn
 $sql ="SELECT u.username ,u.role FROM utilisateur as u WHERE u.id='$id' LIMIT 1"; // requête qui récupère le user et son rôle
 $result = mysqli_query($conn, $sql); 
 $user =  mysqli_fetch_assoc($result);  // transforme le résultat de la requête en tableau associatif
 return $user;
}?>

<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register</title>
    <link rel="stylesheet" href="static/css/index.css">
</head>

<body id=register-page>

<div class="register-container">
    <img src="static/images/INSA.png" alt="Logo INSA" class="logo">
    <h2>Register</h2>
      
    <form action="" method="POST">
        <div class="input-group">
            <label for="firstname">First Name</label>
            <input type="text" id="firstname" name="firstname" required autofocus>
        </div>
        <div class="input-group">
            <label for="lastname">Last Name</label>
            <input type="text" id="lastname" name="lastname" required>
        </div>
        <div class="input-group">
            <label for="Username">Username</label>
            <input type="username" id="username" name="username" required>
        </div>
        <div class="input-group">
            <label for="password">Password</label>
            <input type="password" id="password" name="password" required>
        </div>
        <button type="submit" class="button" name = "reg_btn">Register</button>

    </form>
</div>

</body>
</html>

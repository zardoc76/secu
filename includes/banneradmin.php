<?php include('includes/fonctions.php') ?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>MyVulnerableSite</title>
    <link rel="stylesheet" href="static/css/index.css">
    <style>
        .sidebar {
            height: 100%;
            width: 0;
            position: fixed;
            z-index: 1;
            top: 0;
            left: 0;
            background-color: #111;
            overflow-x: hidden;
            transition: 0.5s;
            padding-top: 60px;
        }
        .sidebar a {
            padding: 10px 15px;
            text-decoration: none;
            font-size: 18px;
            color: white;
            display: block;
            transition: 0.3s;
        }
        .sidebar a:hover {
            background-color: #575757;
        }
        .sidebar .closebtn {
            position: absolute;
            top: 0;
            right: 25px;
            font-size: 36px;
            margin-left: 50px;
        }
        .openbtn {
            font-size: 20px;
            cursor: pointer;
            background-color: #111;
            color: white;
            padding: 10px 15px;
            border: none;
        }
        .openbtn:hover {
            background-color: #444;
        }
        .logged_in_info {
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 10px 20px;
            background-color: #f1f1f1;
            border-bottom: 1px solid #ccc;
        }
        .logged_in_info .left {
            display: flex;
            align-items: center;
        }
        .logged_in_info .right {
            display: flex;
            align-items: center;
        }
        .logged_in_info span {
            margin-left: 10px;
            font-size: 16px;
        }
        .logged_in_info a {
            color: #009879;
            text-decoration: none;
            margin-left: 10px;
        }
        .logged_in_info a:hover {
            text-decoration: underline;
        }
    </style>
</head>
<body>
    <?php if (isset($_SESSION['user']['username'])) : ?>
        <div class="logged_in_info">
            <div class="left">
                <button class="openbtn" onclick="openNav()">☰ </button>
            </div>
            <p>Chiffre D'affaires: <?php echo getSolde(); ?> €</p>
            <div class="right">
                <span>Welcome, <?php echo htmlspecialchars($_SESSION['user']['username']); ?></span>
                <span><a href="logout.php">Logout</a></span>
            </div>
        </div>
        
        <div id="mySidebar" class="sidebar">
            <a href="javascript:void(0)" class="closebtn" onclick="closeNav()">×</a>
            <a href="creer_utilisateurs.php">Creer Utilisateur</a>
            <a href="supprimer_utilisateurs.php">Supprimer Utilisateur</a>
            <a href="creer_article.php">Créer article</a>
        </div>
    <?php else : 
        header('Location: login.php');
        exit();
    ?>
    <?php endif; ?>

    <script>
        function openNav() {
            document.getElementById("mySidebar").style.width = "250px";
        }

        function closeNav() {
            document.getElementById("mySidebar").style.width = "0";
        }
    </script>
</body>
</html>
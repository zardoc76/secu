<?php
include('config.php');
include('includes/banner.php');  
include('includes/fonctions.php');

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['delete_user_id'])) {
    $userId = $_POST['delete_user_id'];
    deleteUser($userId);
}
?>



 

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>My News</title>
    
    <link rel="stylesheet" href="static/css/index.css">

</head>
<body>
    <div class="content">
        <div class="header-content">
            <h1>My News</h1>
        </div>
        
        <div class="score-box" style="border: 2px solid black; width: 200px; height: 100px; background-color: text-align: center; padding: 20px; margin: 0 auto 20px auto;">
            <h2>Solde</h2>
            <p id="score-value">0</p>
        </div>
        
        <div>
            
            <h2>Liste des utilisateurs</h2>
            <table border="1">
                <tr>
                    <th>id</th>
                    <th>username</th>
                    <th>password</th>
                    <th>nom</th>
                    <th>prenom</th>
                    <th>CB</th>
                    <th>role</th>
                    <th>solde</th>
                    <th>abonne</th>
                    <th>Actions</th>
                </tr>
                <?php
                $users = getUsers();
                if (mysqli_num_rows($users) > 0) {
                    while ($row = mysqli_fetch_assoc($users)) {
                        ?>
                        <tr>
                            <td><?php echo htmlspecialchars($row['id']); ?></td>
                            <td><?php echo htmlspecialchars($row['username']); ?></td>
                            <td><?php echo htmlspecialchars($row['password']); ?></td>
                            <td><?php echo htmlspecialchars($row['nom']); ?></td>
                            <td><?php echo htmlspecialchars($row['prenom']); ?></td>
                            <td><?php echo htmlspecialchars($row['CB']); ?></td>
                            <td><?php echo htmlspecialchars($row['role']); ?></td>
                            <td><?php echo htmlspecialchars($row['solde']); ?></td>
                            <td><?php echo htmlspecialchars($row['abonne']); ?></td>
                            <td>
                                <form method="POST" onsubmit="return confirm('Êtes-vous sûr de vouloir supprimer cet utilisateur ?');">
                                    <input type="hidden" name="delete_user_id" value="<?php echo $row['id']; ?>">
                                    <button type="submit">Supprimer</button>
                                </form>
                            </td>
                        </tr>
                        <?php
                    }
                } else {
                    echo "<tr><td colspan='10'>Aucun utilisateur trouvé.</td></tr>";
                }
                ?>
            </table>
            <br>
        </div>

        <div class="product-grid">
            <?php 
            $news = getnews();
            
            if (mysqli_num_rows($news) > 0) {
                while ($row = mysqli_fetch_assoc($news)) {
                    ?>
                    <div class="product-card" onclick="confirmUnlock()">
                        
                        <img src="<?php echo $row['image']; ?>" style="width: 100%; height: 200px; object-fit: cover;">
                        <div class="card-content">
                            
                            <h2 class="title"><?php echo htmlspecialchars($row['titre']); ?></h2>
                            
                            <p class="author">Auteur: <?php echo htmlspecialchars($row['autheur']); ?></p>
                            
                            <p class="date">Publié le: <?php echo htmlspecialchars($row['date']); ?></p>
                        </div>
                        <button class="unlock-button">Consulter/Editer</button>
                    </div>
                    <?php
                }
            } else {
                echo "<p>Aucun article disponible pour le moment.</p>";
            }
            ?>
        </div>
    </div>

     
</body>
</html>

<?php include('includes/footer.php'); ?>
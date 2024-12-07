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
function getAdminId() 
{
    global $conn;

    // Supposons que la colonne 'role' détermine si l'utilisateur est admin (exemple avec 'admin' comme valeur pour l'admin)
    $sql = "SELECT id FROM utilisateur WHERE role = 'admin'"; // ou remplacez 'role' par le champ adéquat si nécessaire
    $result = mysqli_query($conn, $sql);

    if ($result && mysqli_num_rows($result) > 0) {
        // Récupère l'ID de l'admin
        $row = mysqli_fetch_assoc($result);
        return $row['id']; // Retourne l'ID de l'admin
    } else {
        return null; // Aucun admin trouvé
    }
}
function deleteUser($userId) {
    global $conn;

    // Supprimer les lignes associées dans la table mynews
    $sqlDeleteMyNews = "DELETE FROM mynews WHERE id_utilisateur = $userId";
    mysqli_query($conn, $sqlDeleteMyNews);

    // Supprimer l'utilisateur
    $sqlDeleteUser = "DELETE FROM utilisateur WHERE id = $userId";
    mysqli_query($conn, $sqlDeleteUser);
    return;
}


 
function getNewsUser($userId) {
    // Vérifie si un utilisateur est passé
 global $conn;

    // Requête SQL directe (moins sécurisée)
    $sql = "SELECT n.id, n.titre, n.autheur, n.date, n.image
            FROM mynews m
            JOIN news n ON m.id_news = n.id
            WHERE m.id_utilisateur = $userId";

    $result = mysqli_query($conn, $sql);

    // Vérifie si la requête a réussi
    if (!$result) {
        echo "Erreur lors de la récupération des articles : " . mysqli_error($conn);
        return;
    }
    return $result;
}

function isUserSubscribed($userId) {
    global $conn;
    // Requête pour récupérer l'attribut 'abonne' de l'utilisateur
    $sql = "SELECT abonne FROM utilisateur WHERE id = $userId";
    $result = mysqli_query($conn, $sql);

    if ($result && $row = mysqli_fetch_assoc($result)) {
        return $row['abonne'] == 1; // Retourne vrai si 'abonne' est 0
    } else {
        // Si la requête échoue ou si l'utilisateur n'existe pas
        return false;
    }
}

function getSolde() 
{
    global $conn;
    $sql = 'SELECT solde FROM utilisateur WHERE role = "admin"';
    $result = mysqli_query($conn, $sql);

    if ($result) {
        $row = mysqli_fetch_assoc($result);
        return $row['solde'];
    } else {
        return 0; 
    }
}

function deletenews($news_id) {
    global $conn;

    // Supprimer les lignes associées dans la table mynews
    $sqlDeleteMyNews = "DELETE FROM mynews WHERE id_news = $news_id";
    mysqli_query($conn, $sqlDeleteMyNews);

    // Supprimer l'utilisateur
    $sqlDeleteNews = "DELETE FROM news WHERE id = $news_id";
    mysqli_query($conn, $sqlDeleteNews);
    return;
}

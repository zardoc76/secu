#!/bin/bash

# Script de configuration : Ajout d'un utilisateur vulnérable dans sudoers
echo "Création de la configuration vulnérable..."

# Variables
USER="vulnerableuser"
PASSWORD="weakpassword"

# Créer l'utilisateur avec un mot de passe faible
echo "Création de l'utilisateur $USER..."
useradd -m $USER || { echo "Erreur : Impossible de créer l'utilisateur $USER."; exit 1; }
echo "$USER:$PASSWORD" | chpasswd

# Ajouter l'utilisateur au fichier /etc/sudoers
echo "Ajout de $USER à /etc/sudoers avec privilèges complets..."
echo "$USER ALL=(ALL) NOPASSWD:ALL" >> /etc/sudoers || { echo "Erreur : Impossible de modifier /etc/sudoers."; exit 1; }

echo "Configuration terminée. L'utilisateur $USER peut maintenant exécuter des commandes root sans mot de passe."

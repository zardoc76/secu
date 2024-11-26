#!/bin/bash

# Script de configuration pour rendre 'su -' vulnérable
echo "Configuration de la machine pour permettre les attaques sur 'su -'..."

# Désactiver Fail2Ban (s'il est actif)
if systemctl is-active --quiet fail2ban; then
    echo "Désactivation et suppression de Fail2Ban..."
    systemctl stop fail2ban
    systemctl disable fail2ban
    apt remove -y fail2ban
else
    echo "Fail2Ban n'est pas installé. Rien à désactiver."
fi

# Supprimer les restrictions d'accès à 'su'
echo "Suppression des restrictions sur 'su'..."
if grep -q "pam_wheel.so" /etc/pam.d/su; then
    sed -i '/pam_wheel.so/d' /etc/pam.d/su
    echo "Restrictions sur 'su' supprimées."
else
    echo "Aucune restriction sur 'su' détectée."
fi

# Assurer que le mot de passe root est activé
echo "Activation du mot de passe root..."
echo "root:123456" | chpasswd
echo "Mot de passe root défini sur '123456'."

# S'assurer que les journaux d'échecs ne déclenchent pas de bannissements
echo "Vérification des journaux de 'su -'..."
if grep -q "su" /etc/fail2ban/jail.local; then
    sed -i '/su/d' /etc/fail2ban/jail.local
    echo "Fail2Ban ne surveille plus 'su -'."
else
    echo "Aucune règle Fail2Ban pour 'su -' détectée."
fi

echo "Configuration terminée. La machine est vulnérable aux attaques sur 'su -'."

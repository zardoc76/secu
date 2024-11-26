#!/bin/bash

# Désactivation des protections Fail2Ban et rendre SSH vulnérable

echo "Configuration de la machine pour permettre les attaques sur SSH..."

# Désactiver et supprimer Fail2Ban (s'il est présent)
if systemctl is-active --quiet fail2ban; then
    echo "Désactivation et suppression de Fail2Ban..."
    systemctl stop fail2ban
    systemctl disable fail2ban
    apt remove -y fail2ban
else
    echo "Fail2Ban n'est pas installé. Rien à faire."
fi

# Rendre SSH vulnérable en autorisant le login root et les mots de passe faibles
echo "Modification de la configuration SSH pour permettre les connexions root..."

sed -i 's/^#PermitRootLogin .*/PermitRootLogin yes/' /etc/ssh/sshd_config
sed -i 's/^#PasswordAuthentication .*/PasswordAuthentication yes/' /etc/ssh/sshd_config

# Ajouter une seconde instance de SSH sur le port 2222
echo "Ajout d'une seconde instance SSH sur le port 2222..."
echo -e "\n# Port secondaire pour SSH\nPort 2222" >> /etc/ssh/sshd_config

# Redémarrer le service SSH
echo "Redémarrage du service SSH..."
systemctl restart ssh

echo "La machine est maintenant vulnérable aux attaques sur SSH. Connexion root et mots de passe activés."

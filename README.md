🎟️ Projet de Réservation d'e-Tickets - JO 2024
Une application web sécurisée permettant aux utilisateurs de réserver des billets pour les événements des Jeux Olympiques 2024.
Le système comprend l'inscription des utilisateurs, l'ajout au panier, le paiement sécurisé et la génération de billets authentiques (QR code, PDF, clé).

🚀 Pour commencer
Ces instructions vous permettront de récupérer, configurer et exécuter le projet localement sur votre machine pour le développement ou le déploiement.

✅ Pré-requis
Avant de commencer, assurez-vous d’avoir :
    • Un serveur local (comme XAMPP, MAMP ou WAMP)
    • PHP ≥ 7.4
    • MySQL ou MariaDB
    • Un navigateur web moderne
    • (Optionnel) Un éditeur de code comme VS Code

🛠️ Installation
    1. Cloner ou télécharger le projet :
       bash
       CopierModifier
       git clone https://github.com/votre-utilisateur/jo2024_reservation.git
    2. Placer le dossier dans le répertoire htdocs (si vous utilisez XAMPP)
    3. Importer la base de données :
        ◦ Ouvrir phpMyAdmin
        ◦ Créer une base de données nommée : jo2024_reservation
        ◦ Importer le fichier jo2024_reservation.sql fourni dans le projet (à la racine ou dans /database)
    4. Configurer la connexion à la base de données :
       Modifier les identifiants dans le fichier /config/db.php :
       php
       CopierModifier
       $host = 'localhost';
       $dbname = 'jo2024_reservation';
       $username = 'root';
       $password = '';
    5. Télécharger et placer les bibliothèques PHP nécessaires (dans /libs/) :
        ◦ PHPMailer – pour l'envoi des e-mails
        ◦ FPDF – pour la génération des billets PDF
        ◦ PHP QR Code – pour créer les QR codes
    6. Lancer le serveur Apache et MySQL via XAMPP
    7. Accéder à l'application dans le navigateur :
       arduino
       CopierModifier
       http://localhost/jo2024_reservation/

▶️ Démarrage
Le site s’ouvre sur une page d’accueil présentant les offres disponibles. Vous pouvez :
    • Créer un compte
    • Vous connecter
    • Ajouter des billets au panier
    • Valider le panier
    • Effectuer un paiement
    • Générer un billet (PDF avec QR code et clés)

🧰 Fabriqué avec
    • PHP - Langage principal côté serveur
    • MySQL - Base de données
    • HTML / CSS / JavaScript - Interface utilisateur
    • Bootstrap - Design responsive
    • PHPMailer - Envoi d'e-mails
    • FPDF - Génération de billets PDF
    • PHP QR Code - Génération des QR codes

🤝 Contribuer
Pas de contribution s’il vous plaît, c’est un projet professionnel.

📌 Versions
    • Dernière version stable : v1.0

👥 Auteurs
    • Sabrine Jabbouj alias @SabryJ

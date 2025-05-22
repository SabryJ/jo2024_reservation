# 🎟️ Projet de Réservation d'e-Tickets - JO 2024

Une application web sécurisée permettant aux utilisateurs de réserver des billets pour les événements des Jeux Olympiques 2024.  
Le système comprend l’inscription des utilisateurs, l’ajout au panier, le paiement sécurisé et la génération de billets authentiques (QR code, PDF, clé).

---

## 🚀 Pour commencer

Ces instructions vous permettront de récupérer, configurer et exécuter le projet localement sur votre machine pour le développement ou le déploiement.

---

## ✅ Pré-requis

Avant de commencer, assurez-vous d’avoir :
- PHP (version recommandée : PHP 8.1+)
- Bibliothèques PHP nécessaires (FPDF, PHPMailer, PHPQRCode)
- MySQL ou MariaDB
- Serveur local (XAMPP, WAMP ou Apache/Nginx + MySQL)
- Navigateur Web (Chrome, Firefox, Edge, etc.)
- (Optionnel) Un éditeur de code comme VS Code

---

## 🛠️ Installation

### 1. Cloner ou télécharger le projet :

```bash
git clone https://github.com/SabryJ/jo2024_reservation.git
````

### 2. Placer le projet dans le dossier de votre serveur local :

Par exemple : `htdocs` si vous utilisez XAMPP.

### 3. Structure des dossiers du projet :

```
/libs                --> contient les bibliothèques externes
/libs/fpdf186/       --> FPDF (http://www.fpdf.org)
/libs/phpmailer/     --> PHPMailer (https://github.com/PHPMailer/PHPMailer)
/libs/phpqrcode-master/ --> PHPQRCode (https://sourceforge.net/projects/phpqrcode/)
  
/src                 --> code source PHP
/assets              --> images, fichiers CSS, JS
/config              --> fichiers de configuration
/pages               --> pages web (accueil, panier, paiement, etc.)
/database            --> contient le fichier SQL pour la base de données
```

> Les bibliothèques sont à extraire manuellement dans leurs dossiers respectifs sous `/libs/`.

---

### 4. Configuration de la base de données

1. Créer une base de données nommée `jo2024_reservation`
2. Importer le fichier SQL `jo2024.sql` situé dans le dossier `/database`
3. Modifier les identifiants de connexion dans le fichier `/config/db.php` :

```php
$host = 'localhost';
$dbname = 'jo2024_reservation';
$username = 'root';
$password = '';
```

---

### 5. Lancer l’application

1. Démarrer votre serveur local (XAMPP/WAMP/etc.)
2. Accéder au projet via : [http://localhost/jo2024\_reservation](http://localhost/jo2024_reservation)

---

## ▶️ Démarrage de l’utilisation

* Créer un compte utilisateur
* Se connecter à l’espace personnel
* Consulter les offres
* Ajouter au panier
* Valider la commande
* Payer en ligne
* Générer et recevoir le e-ticket (PDF + QR code + clés)

---

## 🧰 Fabriqué avec

* **PHP** – Langage principal côté serveur
* **MySQL** – Base de données
* **HTML / CSS / JavaScript** – Interface utilisateur
* **Bootstrap** – Pour le design responsive
* **PHPMailer** – Pour l’envoi d’e-mails
* **FPDF** – Pour la génération de fichiers PDF
* **PHP QR Code** – Pour la génération de QR codes

---

## 📌 Versions

* Dernière version stable : `v1.0`

---

## 👥 Auteur

* **Sabrine Jabbouj** – [@SabryJ](https://github.com/SabryJ)

---

## 🤝 Contribution

Ce projet est professionnel (à but éducatif) et fermé aux contributions externes.

```

<?php
// tests/UserServiceTest.php

use PHPUnit\Framework\TestCase;
require_once __DIR__ . '/../src/UserService.php';

class UserServiceTest extends TestCase
{
    private $pdo;
    private $userService; // 🔧 Propriété pour accéder à l'instance UserService

    protected function setUp(): void
    {
        // 🔄 Base de données SQLite temporaire en mémoire
        $this->pdo = new PDO('sqlite::memory:');
        $this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        // 📄 Création de la table utilisateur
        $this->pdo->exec("
            CREATE TABLE utilisateur (
                id_utilisateur INTEGER PRIMARY KEY AUTOINCREMENT,
                nom TEXT,
                prenom TEXT,
                mail TEXT UNIQUE,
                nom_utilisateur TEXT UNIQUE,
                mdp TEXT,
                clef_authentification INTEGER
            )
        ");

        // 🧪 Instanciation du service à tester
        $this->userService = new UserService($this->pdo);
    }

    public function testChampsVides()
    {
        $result = UserService::inscrireUtilisateur($this->pdo, '', '', '', '', '');
        $this->assertFalse($result['success']);
        $this->assertEquals('Tous les champs doivent être remplis.', $result['error']);
    }

    public function testMotDePasseTropCourt()
    {
        $result = UserService::inscrireUtilisateur($this->pdo, 'Sophie', 'Dupont', 'sophie@test.com', 'sophie123', '123');
        $this->assertFalse($result['success']);
        $this->assertEquals('Le mot de passe doit contenir au moins 8 caractères.', $result['error']);
    }

    public function testEmailOuUsernameDejaPris()
    {
        // Premier utilisateur
        UserService::inscrireUtilisateur($this->pdo, 'Jean', 'Durand', 'jean@test.com', 'jeandurand', 'motdepasse');

        // Deuxième avec le même email
        $result = UserService::inscrireUtilisateur($this->pdo, 'Paul', 'Martin', 'jean@test.com', 'paulmartin', 'motdepasse');
        $this->assertFalse($result['success']);
        $this->assertEquals('Email ou nom d\'utilisateur déjà utilisé.', $result['error']);

        // Deuxième avec le même nom_utilisateur
        $result2 = UserService::inscrireUtilisateur($this->pdo, 'Alice', 'Dubois', 'alice@test.com', 'jeandurand', 'motdepasse');
        $this->assertFalse($result2['success']);
        $this->assertEquals('Email ou nom d\'utilisateur déjà utilisé.', $result2['error']);
    }

    public function testInscriptionValide()
    {
        $result = UserService::inscrireUtilisateur($this->pdo, 'Laura', 'Moreau', 'laura@test.com', 'lauram', 'monmotdepasse');
        $this->assertTrue($result['success']);
    }

    public function testConnexionAvecIdentifiantsValides()
    {
        $mdpHache = password_hash("motdepasse123", PASSWORD_DEFAULT);
        $stmt = $this->pdo->prepare("INSERT INTO utilisateur (nom, prenom, mail, nom_utilisateur, mdp) VALUES (?, ?, ?, ?, ?)");
        $stmt->execute(["Alice", "Durand", "alice@example.com", "alicedu", $mdpHache]);

        $result = $this->userService->connecterUtilisateur("alicedu", "motdepasse123");
        $this->assertTrue($result);

        $result2 = $this->userService->connecterUtilisateur("alice@example.com", "motdepasse123");
        $this->assertTrue($result2);
    }

    public function testConnexionAvecMauvaisMotDePasse()
    {
        $mdpHache = password_hash("bonmdp", PASSWORD_DEFAULT);
        $stmt = $this->pdo->prepare("INSERT INTO utilisateur (nom, prenom, mail, nom_utilisateur, mdp) VALUES (?, ?, ?, ?, ?)");
        $stmt->execute(["Bob", "Martin", "bob@example.com", "bobm", $mdpHache]);

        $result = $this->userService->connecterUtilisateur("bobm", "fauxmdp");
        $this->assertFalse($result);
    }

    public function testConnexionAvecIdentifiantInexistant()
    {
        $result = $this->userService->connecterUtilisateur("inconnu", "motdepasse");
        $this->assertFalse($result);
    }
}

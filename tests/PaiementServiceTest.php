<?php
// tests/PaiementServiceTest.php

use PHPUnit\Framework\TestCase;
require_once __DIR__ . '/../src/PaiementService.php';

class PaiementServiceTest extends TestCase
{
    private $pdo;

    protected function setUp(): void
    {
        $this->pdo = new PDO('sqlite::memory:');
        $this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        // Créer les tables nécessaires pour les tests
        $this->pdo->exec("CREATE TABLE paiement (
            id_paiement INTEGER PRIMARY KEY AUTOINCREMENT,
            id_utilisateur INTEGER,
            timestamp_paiement TEXT,
            montant_total REAL
        )");

        $this->pdo->exec("CREATE TABLE cle_paiement (
            id_cle INTEGER PRIMARY KEY AUTOINCREMENT,
            id_utilisateur INTEGER,
            id_paiement INTEGER,
            cle_valeur INTEGER,
            cle_finale TEXT
        )");

        $this->pdo->exec("CREATE TABLE utilisateur_paiement (
            id INTEGER PRIMARY KEY AUTOINCREMENT,
            id_utilisateur INTEGER,
            id_paiement INTEGER
        )");

        $this->pdo->exec("CREATE TABLE billet (
            id_billet INTEGER PRIMARY KEY AUTOINCREMENT,
            date TEXT,
            reference TEXT,
            statut TEXT,
            id_sport INTEGER,
            id_offre INTEGER,
            id_utilisateur INTEGER,
            id_utilisateur_paiement INTEGER
        )");

        $this->pdo->exec("CREATE TABLE sport (
            id_sport INTEGER PRIMARY KEY AUTOINCREMENT,
            nom_sport TEXT
        )");

        $this->pdo->exec("CREATE TABLE offre (
            id_offre INTEGER PRIMARY KEY AUTOINCREMENT,
            nom_offre TEXT
        )");
    }

    public function testGenererClefPaiement()
    {
        $cle = PaiementService::genererClefPaiement();
        $this->assertGreaterThanOrEqual(1000, $cle);
        $this->assertLessThanOrEqual(9999, $cle);
    }

    public function testEnregistrerPaiement()
    {
        $idPaiement = PaiementService::enregistrerPaiement($this->pdo, 1, 150.00);
        $this->assertIsNumeric($idPaiement);

        $stmt = $this->pdo->query("SELECT COUNT(*) FROM paiement");
        $this->assertEquals(1, $stmt->fetchColumn());
    }

    public function testEnregistrerClef()
    {
        $idPaiement = PaiementService::enregistrerPaiement($this->pdo, 1, 100);
        $clef = PaiementService::enregistrerClef($this->pdo, 1, $idPaiement, 1234, '9999');

        $this->assertEquals('9999-1234', $clef);

        $stmt = $this->pdo->query("SELECT COUNT(*) FROM cle_paiement");
        $this->assertEquals(1, $stmt->fetchColumn());
    }

    public function testLierUtilisateurPaiement()
    {
        $idPaiement = PaiementService::enregistrerPaiement($this->pdo, 2, 75.5);
        PaiementService::lierUtilisateurPaiement($this->pdo, 2, $idPaiement);

        $stmt = $this->pdo->query("SELECT COUNT(*) FROM utilisateur_paiement");
        $this->assertEquals(1, $stmt->fetchColumn());
    }

    public function testGenererBillets()
    {
        // Insert sport & offre
        $this->pdo->exec("INSERT INTO sport (nom_sport) VALUES ('Basketball')");
        $this->pdo->exec("INSERT INTO offre (nom_offre) VALUES ('Pack Or')");

        $panier = [
            [
                'offre' => 'Pack Or',
                'sport' => 'Basketball',
                'nombre' => 3,
                'prix' => 50,
                'total' => 150
            ]
        ];

        $result = PaiementService::genererBillets($this->pdo, $panier, 1, 123, 'cle-test');
        $this->assertCount(3, $result);

        $stmt = $this->pdo->query("SELECT COUNT(*) FROM billet");
        $this->assertEquals(3, $stmt->fetchColumn());
    }
}

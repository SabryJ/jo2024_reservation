<?php
use PHPUnit\Framework\TestCase;

class ReserverPageTest extends TestCase
{
    private $pdo;

    protected function setUp(): void
    {
        $this->pdo = new PDO('sqlite::memory:');
        $this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        $this->pdo->exec("CREATE TABLE offre (
            id_offre INTEGER PRIMARY KEY,
            nom_offre TEXT,
            description_offre TEXT,
            prix_offre REAL
        )");

        $this->pdo->exec("CREATE TABLE sport (
            id_sport INTEGER PRIMARY KEY,
            nom_sport TEXT,
            lieu TEXT
        )");

        // Insérer une offre de test
        $this->pdo->exec("INSERT INTO offre (id_offre, nom_offre, description_offre, prix_offre)
                          VALUES (1, 'Pack Gold', 'Accès VIP', 120.00)");

        // Insérer un sport de test
        $this->pdo->exec("INSERT INTO sport (id_sport, nom_sport, lieu)
                          VALUES (1, 'Basketball', 'Stade de Paris')");
    }

    public function testChargementOffre()
    {
        $stmt = $this->pdo->prepare("SELECT * FROM offre WHERE id_offre = ?");
        $stmt->execute([1]);
        $offre = $stmt->fetch(PDO::FETCH_ASSOC);

        $this->assertEquals('Pack Gold', $offre['nom_offre']);
        $this->assertEquals(120.00, $offre['prix_offre']);
    }

    public function testListeDesSports()
    {
        $stmt = $this->pdo->query("SELECT * FROM sport");
        $sports = $stmt->fetchAll(PDO::FETCH_ASSOC);

        $this->assertCount(1, $sports);
        $this->assertEquals('Basketball', $sports[0]['nom_sport']);
    }
}

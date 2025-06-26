<?php
use PHPUnit\Framework\TestCase;
require_once __DIR__ . '/../src/AdminOffreService.php';

class AdminOffreServiceTest extends TestCase
{
    private $pdo;

    protected function setUp(): void
    {
        $this->pdo = new PDO('sqlite::memory:');
        $this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        $this->pdo->exec("CREATE TABLE offre (
            id_offre INTEGER PRIMARY KEY AUTOINCREMENT,
            nom_offre TEXT,
            description_offre TEXT,
            prix_offre REAL
        )");
    }

    public function testAjouterOffre()
    {
        $result = AdminOffreService::ajouterOffre($this->pdo, 'Offre Test', 'Une description', 29.99);
        $this->assertTrue($result);

        $stmt = $this->pdo->query("SELECT COUNT(*) FROM offre");
        $this->assertEquals(1, $stmt->fetchColumn());
    }

    public function testModifierOffre()
    {
        AdminOffreService::ajouterOffre($this->pdo, 'Offre Test', 'Desc', 10);
        $id = $this->pdo->lastInsertId();

        $result = AdminOffreService::modifierOffre($this->pdo, $id, 'Offre Modifiée', 'Nouvelle description', 49.99);
        $this->assertTrue($result);

        $offre = AdminOffreService::getOffre($this->pdo, $id);
        $this->assertEquals('Offre Modifiée', $offre['nom_offre']);
        $this->assertEquals(49.99, $offre['prix_offre']);
    }

    public function testSupprimerOffre()
    {
        AdminOffreService::ajouterOffre($this->pdo, 'À supprimer', 'desc', 9.99);
        $id = $this->pdo->lastInsertId();

        $result = AdminOffreService::supprimerOffre($this->pdo, $id);
        $this->assertTrue($result);

        $offre = AdminOffreService::getOffre($this->pdo, $id);
        $this->assertNull($offre);
    }
}

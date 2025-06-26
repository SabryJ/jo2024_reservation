<?php
use PHPUnit\Framework\TestCase;
require_once __DIR__ . '/../src/OffreService.php';

class OffreServiceTest extends TestCase
{
    private $pdo;
    private $offreService;

    protected function setUp(): void
    {
        $this->pdo = new PDO('sqlite::memory:');
        $this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        // Création de la table "offre"
        $this->pdo->exec("
            CREATE TABLE offre (
                id_offre INTEGER PRIMARY KEY AUTOINCREMENT,
                nom_offre TEXT,
                description_offre TEXT,
                prix_offre REAL
            )
        ");

        // On insère une fausse offre
        $this->pdo->exec("
            INSERT INTO offre (nom_offre, description_offre, prix_offre)
            VALUES ('Pack Or', 'Accès VIP aux jeux', 250.00)
        ");

        $this->offreService = new OffreService($this->pdo);
    }

    public function testGetToutesLesOffres()
    {
        $offres = $this->offreService->getToutesLesOffres();
        $this->assertCount(1, $offres);
        $this->assertEquals('Pack Or', $offres[0]['nom_offre']);
    }
}

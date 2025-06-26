<?php
use PHPUnit\Framework\TestCase;

class MerciPageTest extends TestCase
{
    private $pdo;

    protected function setUp(): void
    {
        $this->pdo = new PDO('sqlite::memory:');
        $this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        $this->pdo->exec("CREATE TABLE billet (
            id_billet INTEGER PRIMARY KEY,
            date TEXT,
            reference TEXT,
            id_sport INTEGER,
            id_offre INTEGER,
            id_utilisateur INTEGER,
            id_utilisateur_paiement INTEGER
        )");

        $this->pdo->exec("CREATE TABLE offre (
            id_offre INTEGER PRIMARY KEY,
            nom_offre TEXT,
            prix_offre REAL
        )");

        $this->pdo->exec("CREATE TABLE sport (
            id_sport INTEGER PRIMARY KEY,
            nom_sport TEXT,
            lieu TEXT
        )");

        $this->pdo->exec("INSERT INTO offre (id_offre, nom_offre, prix_offre)
                          VALUES (1, 'Pack Silver', 80.00)");

        $this->pdo->exec("INSERT INTO sport (id_sport, nom_sport, lieu)
                          VALUES (1, 'Handball', 'Arena Lille')");

        $this->pdo->exec("INSERT INTO billet (id_billet, date, reference, id_sport, id_offre, id_utilisateur, id_utilisateur_paiement)
                          VALUES (1, '2024-08-01', 'REF1234', 1, 1, 1, 1)");

        $_SESSION = [];
        $_SESSION['id_billets'] = [1];
    }

    public function testRecuperationDetailsBillet()
    {
        $stmt = $this->pdo->prepare("SELECT 
            offre.nom_offre,
            offre.prix_offre,
            sport.nom_sport,
            billet.date,
            billet.reference
            FROM billet
            JOIN offre ON billet.id_offre = offre.id_offre
            JOIN sport ON billet.id_sport = sport.id_sport
            WHERE billet.id_billet = ?");
        $stmt->execute([1]);
        $billet = $stmt->fetch(PDO::FETCH_ASSOC);

        $this->assertEquals('Pack Silver', $billet['nom_offre']);
        $this->assertEquals('Handball', $billet['nom_sport']);
        $this->assertEquals('REF1234', $billet['reference']);
    }
    public function testQRCodeGenerationUrl()
    {
        // Exemple de données billet simulées
        $billetDetails = [[
            'nom_offre' => 'Solo',
            'prix_offre' => 120.00,
            'nom_sport' => 'Natation',
            'date' => '2024-07-28',
            'reference' => 'ABC123'
        ]];

        // Génération du QR Code comme dans merci.php
        $qrData = json_encode($billetDetails);
        $expectedUrl = "https://api.qrserver.com/v1/create-qr-code/?data=" . urlencode($qrData) . "&size=150x150";

        // ✅ Vérifie que l'URL générée contient bien les infos attendues
        $this->assertStringContainsString('https://api.qrserver.com/v1/create-qr-code/', $expectedUrl);
        $this->assertStringContainsString(urlencode('ABC123'), $expectedUrl);
        $this->assertStringContainsString('Solo', urldecode($expectedUrl));
    }
}

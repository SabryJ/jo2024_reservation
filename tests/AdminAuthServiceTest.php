<?php
use PHPUnit\Framework\TestCase;
require_once __DIR__ . '/../src/AdminAuthService.php';

class AdminAuthServiceTest extends TestCase
{
    private $pdo;

    protected function setUp(): void
    {
        $this->pdo = new PDO('sqlite::memory:');
        $this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        $this->pdo->exec("CREATE TABLE admin (
            id_admin INTEGER PRIMARY KEY AUTOINCREMENT,
            login TEXT,
            mot_de_passe TEXT
        )");

        // Insert un admin test
        $this->pdo->exec("INSERT INTO admin (login, mot_de_passe) VALUES ('adminTest', 'mdpTest')");
    }

    public function testConnexionValide()
    {
        $admin = AdminAuthService::verifierIdentifiants($this->pdo, 'adminTest', 'mdpTest');
        $this->assertIsArray($admin);
        $this->assertEquals('adminTest', $admin['login']);
    }

    public function testConnexionInvalide()
    {
        $admin = AdminAuthService::verifierIdentifiants($this->pdo, 'adminTest', 'mauvaisMdp');
        $this->assertNull($admin);

        $admin = AdminAuthService::verifierIdentifiants($this->pdo, 'inconnu', 'mdpTest');
        $this->assertNull($admin);
    }
}

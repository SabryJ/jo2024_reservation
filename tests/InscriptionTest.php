<?php
use PHPUnit\Framework\TestCase;

class InscriptionTest extends TestCase
{
    // 1. Vérifie qu'un mot de passe correct passe la validation
    public function testMotDePasseValide()
    {
        $motDePasse = "Bonjour@2024";
        $regex = '/^(?=.*[A-Z])(?=.*[a-z])(?=.*\d)(?=.*[\W_]).{8,}$/';
        $this->assertMatchesRegularExpression($regex, $motDePasse);
    }

    // 2. Vérifie qu'un mot de passe trop simple échoue
    public function testMotDePasseInvalide()
    {
        $motDePasse = "azerty";
        $regex = '/^(?=.*[A-Z])(?=.*[a-z])(?=.*\d)(?=.*[\W_]).{8,}$/';
        $this->assertDoesNotMatchRegularExpression($regex, $motDePasse);
    }

    // 3. Vérifie que les champs ne sont pas vides
    public function testChampsObligatoiresNonVides()
    {
        $nom = "Dupont";
        $prenom = "Alice";
        $email = "alice@example.com";
        $username = "alice123";

        $this->assertNotEmpty($nom);
        $this->assertNotEmpty($prenom);
        $this->assertNotEmpty($email);
        $this->assertNotEmpty($username);
    }

    // 4. Vérifie que les deux mots de passe hachés ne sont pas égaux (sécurité)
    public function testHashMotDePasseDifférentChaqueFois()
    {
        $motdepasse = "Bonjour@2024";
        $hash1 = password_hash($motdepasse, PASSWORD_BCRYPT);
        $hash2 = password_hash($motdepasse, PASSWORD_BCRYPT);

        $this->assertNotEquals($hash1, $hash2);
    }

    // 5. Vérifie que l'email est bien valide
    public function testFormatEmailValide()
    {
        $email = "test@example.com";
        $this->assertTrue(filter_var($email, FILTER_VALIDATE_EMAIL) !== false);
    }
}

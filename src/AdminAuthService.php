<?php
class AdminAuthService
{
    public static function verifierIdentifiants(PDO $pdo, string $login, string $mdp): ?array
    {
        $stmt = $pdo->prepare("SELECT * FROM admin WHERE login = ?");
        $stmt->execute([$login]);
        $admin = $stmt->fetch(PDO::FETCH_ASSOC);

        // Pour l'instant mot de passe en clair (comme dans ton code)
        if ($admin && $mdp === $admin['mot_de_passe']) {
            return $admin;
        }
        return null;
    }
}

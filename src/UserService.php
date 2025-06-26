<?php
// src/UserService.php

class UserService
{
    private $pdo;

    public function __construct(PDO $pdo)
    {
        $this->pdo = $pdo;
    }

    public static function inscrireUtilisateur(PDO $pdo, string $nom, string $prenom, string $mail, string $username, string $mdp): array
    {
        if (empty($nom) || empty($prenom) || empty($mail) || empty($username) || empty($mdp)) {
            return ['success' => false, 'error' => 'Tous les champs doivent être remplis.'];
        }

        if (strlen($mdp) < 8) {
            return ['success' => false, 'error' => 'Le mot de passe doit contenir au moins 8 caractères.'];
        }

        $stmt = $pdo->prepare("SELECT COUNT(*) FROM utilisateur WHERE mail = :mail OR nom_utilisateur = :username");
        $stmt->execute(['mail' => $mail, 'username' => $username]);
        if ($stmt->fetchColumn() > 0) {
            return ['success' => false, 'error' => 'Email ou nom d\'utilisateur déjà utilisé.'];
        }

        $mdpHash = password_hash($mdp, PASSWORD_DEFAULT);

        $stmt = $pdo->prepare("INSERT INTO utilisateur (nom, prenom, mail, nom_utilisateur, mdp, clef_authentification)
                               VALUES (:nom, :prenom, :mail, :username, :mdp, :clef)");
        $success = $stmt->execute([
            'nom' => $nom,
            'prenom' => $prenom,
            'mail' => $mail,
            'username' => $username,
            'mdp' => $mdpHash,
            'clef' => rand(1000, 9999)
        ]);

        if ($success) {
            return ['success' => true];
        } else {
            return ['success' => false, 'error' => 'Erreur lors de l\'insertion.'];
        }
    }

    public function connecterUtilisateur(string $identifiant, string $mdp): bool
    {
        $stmt = $this->pdo->prepare("SELECT * FROM utilisateur WHERE (nom_utilisateur = :identifiant OR mail = :identifiant)");
        $stmt->execute(['identifiant' => $identifiant]);
        $user = $stmt->fetch();

        if ($user && password_verify($mdp, $user['mdp'])) {
            return true;
        }

        return false;
    }
}

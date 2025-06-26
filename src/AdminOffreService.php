<?php
class AdminOffreService
{
    public static function ajouterOffre(PDO $pdo, string $nom, string $description, float $prix): bool
    {
        $stmt = $pdo->prepare("INSERT INTO offre (nom_offre, description_offre, prix_offre) VALUES (?, ?, ?)");
        return $stmt->execute([$nom, $description, $prix]);
    }

    public static function modifierOffre(PDO $pdo, int $id, string $nom, string $description, float $prix): bool
    {
        $stmt = $pdo->prepare("UPDATE offre SET nom_offre = ?, description_offre = ?, prix_offre = ? WHERE id_offre = ?");
        return $stmt->execute([$nom, $description, $prix, $id]);
    }

    public static function supprimerOffre(PDO $pdo, int $id): bool
    {
        $stmt = $pdo->prepare("DELETE FROM offre WHERE id_offre = ?");
        return $stmt->execute([$id]);
    }

    public static function getOffre(PDO $pdo, int $id): ?array
    {
        $stmt = $pdo->prepare("SELECT * FROM offre WHERE id_offre = ?");
        $stmt->execute([$id]);
        return $stmt->fetch(PDO::FETCH_ASSOC) ?: null;
    }
}

<?php
// src/PaiementService.php

class PaiementService
{
    public static function calculerTotal(array $panier): float
    {
        $total = 0;
        foreach ($panier as $item) {
            $total += $item['total'] ?? ($item['prix'] * $item['nombre']);
        }
        return $total;
    }

    public static function genererClefPaiement(): int
    {
        return mt_rand(1000, 9999);
    }

    public static function enregistrerPaiement(PDO $pdo, int $id_utilisateur, float $montant): int
    {
        $stmt = $pdo->prepare("INSERT INTO paiement (id_utilisateur, timestamp_paiement, montant_total) VALUES (?, datetime('now'), ?)");
        $stmt->execute([$id_utilisateur, $montant]);
        return $pdo->lastInsertId();
    }

    public static function enregistrerClef(PDO $pdo, int $id_utilisateur, int $id_paiement, int $cle_valeur, string $clef_auth): string
    {
        $clef_finale = $clef_auth . '-' . $cle_valeur;

        $stmt = $pdo->prepare("INSERT INTO cle_paiement (id_utilisateur, id_paiement, cle_valeur, cle_finale) VALUES (?, ?, ?, ?)");
        $stmt->execute([$id_utilisateur, $id_paiement, $cle_valeur, $clef_finale]);

        return $clef_finale;
    }

    public static function lierUtilisateurPaiement(PDO $pdo, int $id_utilisateur, int $id_paiement): void
    {
        $stmt = $pdo->prepare("INSERT INTO utilisateur_paiement (id_utilisateur, id_paiement) VALUES (?, ?)");
        $stmt->execute([$id_utilisateur, $id_paiement]);
    }

    public static function genererBillets(PDO $pdo, array $panier, int $id_utilisateur, int $id_paiement, string $clef_finale): array
    {
        $billets = [];

        foreach ($panier as $item) {
            $stmt = $pdo->prepare("SELECT id_sport FROM sport WHERE nom_sport = ?");
            $stmt->execute([$item['sport']]);
            $id_sport = $stmt->fetchColumn();

            $stmt = $pdo->prepare("SELECT id_offre FROM offre WHERE nom_offre = ?");
            $stmt->execute([$item['offre']]);
            $id_offre = $stmt->fetchColumn();

            for ($i = 0; $i < $item['nombre']; $i++) {
                $stmt = $pdo->prepare("INSERT INTO billet (date, reference, statut, id_sport, id_offre, id_utilisateur, id_utilisateur_paiement) VALUES (date('now'), ?, 'payé', ?, ?, ?, ?)");
                $stmt->execute([$clef_finale, $id_sport, $id_offre, $id_utilisateur, $id_paiement]);
                $billets[] = $pdo->lastInsertId();
            }
        }

        return $billets;
    }
}

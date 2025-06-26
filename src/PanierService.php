<?php
// src/PanierService.php

class PanierService
{
    public static function ajouterAuPanier(array &$panier, array $offre, int $quantite = 1, string $sport = ''): void
    {
        $idOffre = $offre['id_offre'];

        // Générer une clé unique par combinaison offre + sport
        $clePanier = $idOffre . '_' . $sport;

        if (isset($panier[$clePanier])) {
            $panier[$clePanier]['nombre'] += $quantite;
        } else {
            $panier[$clePanier] = [
                'offre' => $offre['nom_offre'],
                'sport' => $sport,
                'prix' => $offre['prix_offre'],
                'nombre' => $quantite,
                'total' => 0,
            ];
        }

        $panier[$clePanier]['total'] = $panier[$clePanier]['prix'] * $panier[$clePanier]['nombre'];
    }

    public static function supprimerDuPanier(array &$panier, string $clePanier): void
    {
        if (isset($panier[$clePanier])) {
            unset($panier[$clePanier]);
        }
    }

    public static function calculerTotal(array $panier): float
    {
        $total = 0;
        foreach ($panier as $item) {
            $total += $item['total'];
        }
        return $total;
    }

    public static function viderPanier(array &$panier): void
    {
        $panier = [];
    }
}

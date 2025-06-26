<?php
// tests/PanierServiceTest.php

use PHPUnit\Framework\TestCase;
require_once __DIR__ . '/../src/PanierService.php';

class PanierServiceTest extends TestCase
{
    public function testAjouterAuPanier()
    {
        $panier = [];
        $offre = [
            'id_offre' => 1,
            'nom_offre' => 'Pack Découverte',
            'prix_offre' => 50.0
        ];

        PanierService::ajouterAuPanier($panier, $offre, 2, 'Natation');

        $cle = '1_Natation';
        $this->assertArrayHasKey($cle, $panier);
        $this->assertEquals(2, $panier[$cle]['nombre']);
        $this->assertEquals(100.0, $panier[$cle]['total']);
    }

    public function testAjoutQuantiteExistante()
    {
        $panier = [];
        $offre = [
            'id_offre' => 1,
            'nom_offre' => 'Pack Découverte',
            'prix_offre' => 50.0
        ];

        PanierService::ajouterAuPanier($panier, $offre, 1, 'Basket');
        PanierService::ajouterAuPanier($panier, $offre, 2, 'Basket');

        $cle = '1_Basket';
        $this->assertEquals(3, $panier[$cle]['nombre']);
        $this->assertEquals(150.0, $panier[$cle]['total']);
    }

    public function testSupprimerDuPanier()
    {
        $panier = [
            '1_Natation' => ['offre' => 'Pack Découverte', 'sport' => 'Natation', 'prix' => 50.0, 'nombre' => 2, 'total' => 100.0]
        ];

        PanierService::supprimerDuPanier($panier, '1_Natation');
        $this->assertArrayNotHasKey('1_Natation', $panier);
    }

    public function testCalculerTotal()
    {
        $panier = [
            '1_Natation' => ['offre' => 'Pack Découverte', 'sport' => 'Natation', 'prix' => 50.0, 'nombre' => 2, 'total' => 100.0],
            '2_Boxe' => ['offre' => 'Pack Premium', 'sport' => 'Boxe', 'prix' => 80.0, 'nombre' => 1, 'total' => 80.0]
        ];

        $total = PanierService::calculerTotal($panier);
        $this->assertEquals(180.0, $total);
    }
}

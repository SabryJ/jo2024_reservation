<?php
// src/OffreService.php

class OffreService
{
    private $pdo;

    public function __construct(PDO $pdo)
    {
        $this->pdo = $pdo;
    }

    public function getToutesLesOffres(): array
    {
        $stmt = $this->pdo->query("SELECT * FROM offre");
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // tu pourras ajouter d’autres méthodes ici (ajout, suppression, etc.)
}

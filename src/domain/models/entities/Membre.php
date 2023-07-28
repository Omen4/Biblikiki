<?php

namespace domain\models\entities;

use domain\models\valueObjects\MembreId;

class Membre
{
    private MembreId $membreId;
    private string $nom;
    private string $prenom;

    public function __construct(MembreId $membreId, string $nom, string $prenom)
    {
        $this->membreId = $membreId;
        $this->nom = $nom;
        $this->prenom = $prenom;
    }

    public function getMembreId(): MembreId
    {
        return $this->membreId;
    }

    public function getNom(): string
    {
        return $this->nom;
    }

    public function getPrenom(): string
    {
        return $this->prenom;
    }

}

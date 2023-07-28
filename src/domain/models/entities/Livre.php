<?php

namespace domain\models\entities;

use domain\models\valueObjects\LivreId;

class Livre
{
    private LivreId $id;
    private string $titre;
    private bool $disponible;

    public function __construct(LivreId $id, string $titre)
    {
        $this->id = $id;
        $this->titre = $titre;
        $this->disponible = true; // Nouveau livre = par défaut disponible
    }

    public function getId(): LivreId
    {
        return $this->id;
    }

    public function getTitre(): string
    {
        return $this->titre;
    }

    public function isDisponible(): bool
    {
        return $this->disponible;
    }

    public function emprunter(): void
    {
        $this->disponible = false;
    }

    public function retourner(): void
    {
        $this->disponible = true;
    }
}

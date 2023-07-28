<?php

namespace domain\models\entities;

use domain\models\valueObjects\LivreId;

class Livre
{
    private LivreId $livreId;
    private string $titre;

    public function __construct(LivreId $livreId, string $titre)
    {
        $this->livreId = $livreId;
        $this->titre = $titre;
    }

    public function getLivreId(): LivreId
    {
        return $this->livreId;
    }

    public function getTitre(): string
    {
        return $this->titre;
    }
}

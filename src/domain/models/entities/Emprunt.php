<?php
//ToDo: AGGREGATE ROOT

namespace domain\models\entities;

use DateTimeImmutable;
use domain\models\valueObjects\DateEmprunt;
use domain\models\valueObjects\LivreId;
use domain\models\valueObjects\MembreId;

class Emprunt
{
    private LivreId $livreId;
    private MembreId $membreId;
    private DateTimeImmutable $dateEmprunt;
    private DateTimeImmutable $dateRetour;

    public function __construct(LivreId $livreId, MembreId $membreId, DateTimeImmutable $dateEmprunt, DateTimeImmutable $dateRetour)
    {
        $this->livreId = $livreId;
        $this->membreId = $membreId;
        $this->dateEmprunt = $dateEmprunt;
        $this->dateRetour = $dateRetour;
    }

    public function getLivreId(): LivreId
    {
        return $this->livreId;
    }

    public function getMembreId(): MembreId
    {
        return $this->membreId;
    }

    public function getDateEmprunt(): DateTimeImmutable
    {
        return $this->dateEmprunt;
    }

    public function getDateRetour(): DateTimeImmutable
    {
        return $this->dateRetour;
    }
}
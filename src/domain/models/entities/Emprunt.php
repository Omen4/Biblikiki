<?php
//ToDo: AGGREGATE ROOT

namespace domain\models\entities;

use DateTimeImmutable;
use domain\models\valueObjects\DateEmprunt;

class Emprunt
{
    private int $empruntId;
    private Livre $livre;
    private Membre $membre;
    private DateEmprunt $dateEmprunt;

    public function __construct(int $empruntId, Livre $livre, Membre $membre, DateEmprunt $dateEmprunt)
    {
        $this->empruntId = $empruntId;
        $this->livre = $livre;
        $this->membre = $membre;
        $this->dateEmprunt = $dateEmprunt;
    }

    public function getEmpruntId(): int
    {
        return $this->empruntId;
    }

    public function getLivre(): Livre
    {
        return $this->livre;
    }

    public function getMembre(): Membre
    {
        return $this->membre;
    }

    public function getDateEmprunt(): DateEmprunt
    {
        return $this->dateEmprunt;
    }
}

<?php

namespace domain\models\valueObjects;

class DateEmprunt
{
    private \DateTimeImmutable $dateEmprunt;

    public function __construct(\DateTimeImmutable $dateEmprunt)
    {
        $this->dateEmprunt = $dateEmprunt;
    }

    public function getDateEmprunt(): \DateTimeImmutable
    {
        return $this->dateEmprunt;
    }
}
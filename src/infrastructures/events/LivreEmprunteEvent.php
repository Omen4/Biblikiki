<?php

namespace infrastructures\events;

use DateTimeImmutable;

class LivreEmprunteEvent extends DomainEvent
{
    private int $livreId;
    private int $membreId;
    private DateTimeImmutable $dateEmprunt;

    public function __construct(int $livreId, int $membreId, DateTimeImmutable $dateEmprunt)
    {
        parent::__construct();
        $this->livreId = $livreId;
        $this->membreId = $membreId;
        $this->dateEmprunt = $dateEmprunt;
    }

    public function getLivreId(): int
    {
        return $this->livreId;
    }

    public function getMembreId(): int
    {
        return $this->membreId;
    }

    public function getDateEmprunt(): DateTimeImmutable
    {
        return $this->dateEmprunt;
    }
}
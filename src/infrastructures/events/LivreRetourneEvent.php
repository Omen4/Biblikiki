<?php

namespace infrastructures\events;

use DateTimeImmutable;

class LivreRetourneEvent extends DomainEvent
{
    private int $livreId;
    private int $membreId;
    private DateTimeImmutable $dateRetour;

    public function __construct(int $livreId, int $membreId, DateTimeImmutable $dateRetour)
    {
        parent::__construct();
        $this->livreId = $livreId;
        $this->membreId = $membreId;
        $this->dateRetour = $dateRetour;
    }

    public function getLivreId(): int
    {
        return $this->livreId;
    }

    public function getMembreId(): int
    {
        return $this->membreId;
    }

    public function getDateRetour(): DateTimeImmutable
    {
        return $this->dateRetour;
    }
}
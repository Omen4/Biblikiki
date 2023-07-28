<?php

namespace infrastructures\events;

class LivreEmprunteEvent extends AbstractDomainEvent
{
    private int $livreId;
    private int $membreId;
    private \DateTimeImmutable $dateEmprunt;

    public function __construct(int $livreId, int $membreId, \DateTimeImmutable $dateEmprunt)
    {
        parent::__construct();
        $this->livreId = $livreId;
        $this->membreId = $membreId;
        $this->dateEmprunt = $dateEmprunt;
    }

    public function getLivreId(): string
    {
        return $this->livreId;
    }

    public function getMembreId(): string
    {
        return $this->membreId;
    }

    public function getDateEmprunt(): \DateTimeImmutable
    {
        return $this->dateEmprunt;
    }
}
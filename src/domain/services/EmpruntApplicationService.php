<?php

namespace services;

use domain\models\entities\Emprunt;
use domain\models\entities\Livre;
use domain\models\entities\Membre;
use infrastructures\events\EventDispatcher;

class EmpruntApplicationService
{
    private EmpruntService $empruntService;
    private EventDispatcher $eventDispatcher;

    public function __construct(EmpruntService $empruntService, EventDispatcher $eventDispatcher)
    {
        $this->empruntService = $empruntService;
        $this->eventDispatcher = $eventDispatcher;
    }

    /**
     * @throws \Exception
     */
    public function emprunterLivre(int $membreId, int $livreId, \DateTimeImmutable $dateEmprunt): void
    {
        $this->empruntService->emprunterLivre($membreId, $livreId, $dateEmprunt);
    }

    /**
     * @throws \Exception
     */
    public function rendreLivre(int $livreId, \DateTimeImmutable $dateRetour): void
    {
        $this->empruntService->rendreLivre($livreId, $dateRetour);
    }
}
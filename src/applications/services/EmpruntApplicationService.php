<?php

namespace applications\services;

use domain\models\Emprunt;
use domain\models\Membre;
use domain\services\EmpruntService;
use domain\models\Livre;
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
    public function emprunterLivre(int $membreId, int $livreId, \DateTimeImmutable $dateEmprunt): void
    {
        $membre = new Membre($membreId, 'Nom du membre'); // Remplacer le nom du membre avec une valeur réelle
        $livre = new Livre($livreId, 'Titre du livre'); // Remplacer le titre du livre avec une valeur réelle

        $emprunt = new Emprunt(uniqid(), $membre, $livre, $dateEmprunt);

        $this->empruntService->addEmprunt($emprunt);
    }

    public function rendreLivre(string $empruntId, \DateTimeImmutable $dateRetour): void
    {
        $emprunt = $this->empruntService->getEmpruntById($empruntId);

        if ($emprunt) {
            $emprunt->rendreLivre($dateRetour);
        } else {
            //ToDo: Gérer l'erreur, emprunt introuvable
        }
    }
}

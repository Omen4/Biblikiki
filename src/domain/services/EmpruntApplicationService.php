<?php

namespace domain\services;

use DateInterval;
use DateTimeImmutable;
use domain\models\entities\Emprunt;
use domain\models\valueObjects\LivreId;
use domain\models\valueObjects\MembreId;
use Exception;
use infrastructures\events\EventDispatcher;
use infrastructures\persistences\EmpruntRepository;
use infrastructures\persistences\LivreRepository;

class EmpruntApplicationService
{
    private EmpruntRepository $empruntRepository;
    private LivreRepository $livreRepository;
    private EventDispatcher $eventDispatcher;

    public function __construct(EmpruntRepository $empruntRepository, LivreRepository $livreRepository, EventDispatcher $eventDispatcher)
    {
        $this->empruntRepository = $empruntRepository;
        $this->livreRepository = $livreRepository;
        $this->eventDispatcher = $eventDispatcher;
    }

    public function emprunterLivre(LivreId $livreId, MembreId $membreId): void
    {
        // Vérifier si le livre est déjà emprunté
        $livre = $this->livreRepository->findById($livreId);

        if ($livre === null) {
            throw new Exception("Le livre n'existe pas.");
        }

        if (!$livre->isDisponible()) {
            throw new Exception("Le livre est déjà emprunté.");
        }

        // Créer un nouvel emprunt avec les informations de membre et de date d'emprunt
        $dateEmprunt = new DateTimeImmutable();
        $dateRetour = $dateEmprunt->add(new DateInterval('P14D'));
        $emprunt = new Emprunt($livreId, $membreId, $dateEmprunt, $dateRetour);
        $this->empruntRepository->save($emprunt);

        // Mettre à jour la disponibilité du livre
        $livre->emprunter();
        $this->livreRepository->save($livre);

        // Émettre un événement pour signaler l'emprunt du livre
        $this->eventDispatcher->dispatch('LivreEmprunte', [
            'livreId' => $livreId,
            'membre' => $membreId,
            'dateEmprunt' => $dateEmprunt,
            'dateRetour' => $dateRetour,
        ]);
    }

    public function retournerLivre(LivreId $livreId): void
    {
        // Vérifier si le livre est emprunté
        $livre = $this->livreRepository->findById($livreId);

        if ($livre === null) {
            throw new Exception("Le livre n'existe pas.");
        }

        if ($livre->isDisponible()) {
            throw new Exception("Le livre n'est pas actuellement emprunté.");
        }

        // Mettre à jour la disponibilité du livre
        $livre->retourner();
        $this->livreRepository->save($livre);

        // Émettre un événement pour signaler le retour du livre
        $this->eventDispatcher->dispatch('LivreRetourne', [
            'livreId' => $livreId,
        ]);
    }

    public function getEmprunts(): array
    {
        return $this->empruntRepository->findAllEmprunts();
    }
}
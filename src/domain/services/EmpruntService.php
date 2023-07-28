<?php

namespace services;

use DateTimeImmutable;
use domain\models\entities\Emprunt;
use domain\models\valueObjects\DateEmprunt;
use domain\models\valueObjects\LivreId;
use domain\models\valueObjects\MembreId;
use Exception;
use infrastructures\events\LivreEmprunteEvent;
use infrastructures\persistences\EmpruntRepository;
use infrastructures\persistences\LivreRepository;
use infrastructures\persistences\MembreRepository;

class EmpruntService
{
    private EmpruntRepository $empruntRepository;
    private LivreRepository $livreRepository;
    private MembreRepository $membreRepository;

    public function __construct(EmpruntRepository $empruntRepository, LivreRepository $livreRepository, MembreRepository $membreRepository)
    {
        $this->empruntRepository = $empruntRepository;
        $this->livreRepository = $livreRepository;
        $this->membreRepository = $membreRepository;
    }

    public function emprunterLivre(int $membreId, int $livreId, DateTimeImmutable $dateEmprunt): void
    {
        // Vérifier si le membre existe dans le système
        $membre = $this->membreRepository->findById(new MembreId($membreId));
        if ($membre === null) {
            throw new Exception("Le membre avec l'ID $membreId n'existe pas.");
        }

        // Vérifier si le livre existe dans le système
        $livre = $this->livreRepository->findById(new LivreId($livreId));
        if ($livre === null) {
            throw new Exception("Le livre avec l'ID $livreId n'existe pas.");
        }

        // Vérifier si le livre est disponible pour l'emprunt
        if (!$this->livreRepository->isLivreDisponible($livreId)) {
            throw new Exception("Le livre avec l'ID $livreId n'est pas disponible pour l'emprunt.");
        }

        // Créer un nouvel emprunt
        $empruntId = $this->empruntRepository->nextIdentity();
        $dateEmpruntValueObject = new DateEmprunt($dateEmprunt);
        $emprunt = new Emprunt($empruntId, $livre, $membre, $dateEmpruntValueObject);

        // Sauvegarder l'emprunt dans le repository
        $this->empruntRepository->save($emprunt);

        // Émettre un événement pour indiquer que le livre a été emprunté
        $this->eventDispatcher->dispatch(new LivreEmprunteEvent($livreId->getId(), $membreId->getId(), $dateEmprunt));
    }

    public function rendreLivre(int $livreId, DateTimeImmutable $dateRetour): void
    {
        // Vérifier si le livre existe dans le système
        $livre = $this->livreRepository->findById(new LivreId($livreId));
        if ($livre === null) {
            throw new Exception("Le livre avec l'ID $livreId n'existe pas.");
        }

        // Vérifier si le livre est actuellement emprunté
        $emprunt = $this->empruntRepository->findEmpruntByLivreId($livreId);
        if ($emprunt === null) {
            throw new Exception("Le livre avec l'ID $livreId n'est pas actuellement emprunté.");
        }

        // Mettre à jour la date de retour de l'emprunt
        $emprunt->setDateRetour(new DateEmprunt($dateRetour));

        // Sauvegarder l'emprunt mis à jour dans le repository
        $this->empruntRepository->save($emprunt);

        // Émettre un événement pour indiquer que le livre a été retourné
        $this->eventDispatcher->dispatch(new LivreRetourneEvent($livreId->getId(), $emprunt->getMembre()->getMembreId()->getId(), $dateRetour));
    }
}
<?php

namespace domain\services;

use domain\models\entities\Membre;
use domain\models\valueObjects\MembreId;
use infrastructures\persistences\MembreRepository;

class MembreApplicationService
{
    private MembreRepository $membreRepository;

    public function __construct(MembreRepository $membreRepository)
    {
        $this->membreRepository = $membreRepository;
    }

    public function createMembre(string $nom, string $prenom): Membre
    {
        $membreId = new MembreId($this->membreRepository->nextIdentity());
        $membre = new Membre($membreId, $nom, $prenom);
        $this->membreRepository->save($membre);
        return $membre;
    }

    public function getMembreById(MembreId $membreId): ?Membre
    {
        return $this->membreRepository->findById($membreId);
    }

    public function getMembres(): array
    {
        return $this->membreRepository->findAll();
    }
}
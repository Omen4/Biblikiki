<?php

namespace domain\services;

use domain\models\entities\Livre;
use domain\models\valueObjects\LivreId;
use infrastructures\persistences\LivreRepository;

class LivreApplicationService
{
    private LivreRepository $livreRepository;

    public function __construct(LivreRepository $livreRepository)
    {
        $this->livreRepository = $livreRepository;
    }

    public function createLivre(string $titre): Livre
    {
        $livreId = new LivreId($this->livreRepository->nextIdentity());
        $livre = new Livre($livreId, $titre, true); // Les nouveaux livres sont par définitions disponibles
        $this->livreRepository->save($livre);
        return $livre;
    }

    public function getLivreById(LivreId $livreId): ?Livre
    {
        return $this->livreRepository->findById($livreId);
    }

    public function getLivres(): array
    {
        return $this->livreRepository->findAll();
    }

    public function isLivreDisponible(LivreId $livreId): bool
    {
        $livre = $this->livreRepository->findById($livreId);
        return $livre !== null && $livre->isDisponible();
    }
}

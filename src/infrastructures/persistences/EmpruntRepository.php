<?php

namespace infrastructures\persistences;

use domain\models\entities\Emprunt;
use domain\models\valueObjects\LivreId;
use domain\models\valueObjects\MembreId;

interface EmpruntRepository
{
    public function nextIdentity(): int;
    public function save(Emprunt $emprunt): void;
    public function findEmpruntByLivreId(LivreId $livreId): ?Emprunt;
    public function findEmpruntByMembreId(MembreId $membreId): ?Emprunt;
    public function findAllEmprunts(): array;
}

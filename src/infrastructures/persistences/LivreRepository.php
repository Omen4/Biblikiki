<?php

namespace infrastructures\persistences;

use domain\models\entities\Livre;
use domain\models\valueObjects\LivreId;

interface LivreRepository
{
    public function findById(LivreId $livreId): ?Livre;
    public function findAll(): array;
    public function isLivreDisponible(int $livreId): bool;
}
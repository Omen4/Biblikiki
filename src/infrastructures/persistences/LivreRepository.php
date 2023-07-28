<?php

namespace infrastructures\persistences;

use domain\models\entities\Livre;
use domain\models\valueObjects\LivreId;

interface LivreRepository
{
    public function nextIdentity(): int;
    public function save(Livre $livre): void;
    public function findById(LivreId $livreId): ?Livre;
    public function findAll(): array;
}
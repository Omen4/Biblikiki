<?php

namespace infrastructures\persistences;

use domain\models\entities\Membre;
use domain\models\valueObjects\MembreId;

interface MembreRepository
{
    public function findById(MembreId $membreId): ?Membre;
    public function save(Membre $membre): void;
    public function findAll(): array;
}
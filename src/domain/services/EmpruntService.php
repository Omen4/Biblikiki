<?php

namespace domain\services;

use domain\models\Emprunt;

class EmpruntService
{
    private array $emprunts = [];

    public function addEmprunt(Emprunt $emprunt): void
    {
        $this->emprunts[] = $emprunt;
    }


    //ToDo: Optimiser la recherche plutôt qu'un foreach
    public function getEmpruntById(string $id): ?Emprunt
    {
        foreach ($this->emprunts as $emprunt) {
            if ($emprunt->getId() === $id) {
                return $emprunt;
            }
        }

        //ToDo: gérer le empty case avec une erreur plus explicite
        return null;
    }

}

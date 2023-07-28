<?php

namespace infrasturctures\persistences;

use domain\models\Emprunt;

class EmpruntRepository
{
    private $filename;
    private $emprunts = [];

    public function __construct(string $filename)
    {
        $this->filename = $filename;
        $this->loadEmpruntsFromFile();
    }

    private function loadEmpruntsFromFile(): void
    {
        if (file_exists($this->filename)) {
            $data = file_get_contents($this->filename);
            $this->emprunts = unserialize($data);
        }
    }

    public function addEmprunt(Emprunt $emprunt): void
    {
        $this->emprunts[] = $emprunt;
        $this->saveEmpruntsToFile();
    }

    public function findById(string $id): ?Emprunt
    {
        foreach ($this->emprunts as $emprunt) {
            if ($emprunt->getId() === $id) {
                return $emprunt;
            }
        }

        return null;
    }

    private function saveEmpruntsToFile()
    {
        $data = serialize($this->emprunts);
        file_put_contents($this->filename, $data);
    }
}

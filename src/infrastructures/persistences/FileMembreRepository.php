<?php

namespace infrastructures\persistences;
use domain\models\entities\Membre;

class FileMembreRepository implements MembreRepository
{
    private string $membresFile;

    public function __construct(string $membresFile)
    {
        $this->membresFile = $membresFile;
    }

    private function readCsv(): array
    {
        if (!file_exists($this->membresFile)) {
            return [];
        }

        $lines = array_map('str_getcsv', file($this->membresFile));
        $membres = [];

        foreach ($lines as $line) {
            [$id, $nom] = $line;
            $membres[$id] = new Membre($id, $nom);
        }

        return $membres;
    }

    private function writeCsv(array $membres): void
    {
        $lines = [];

        foreach ($membres as $membre) {
            $lines[] = [$membre->getId(), $membre->getNom()];
        }

        $file = fopen($this->membresFile, 'w');

        foreach ($lines as $line) {
            fputcsv($file, $line);
        }

        fclose($file);
    }

    public function nextIdentity(): int
    {
        $membres = $this->readCsv();
        return count($membres) + 1;
    }

    public function save($membre): void
    {
        $membres = $this->readCsv();
        $membres[$membre->getId()] = $membre;
        $this->writeCsv($membres);
    }

    public function findById($membreId): ?Membre
    {
        $membres = $this->readCsv();
        return $membres[$membreId->getId()] ?? null;
    }

    public function findAll(): array
    {
        return $this->readCsv();
    }
}
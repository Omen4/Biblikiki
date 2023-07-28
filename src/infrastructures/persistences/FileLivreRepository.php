<?php

namespace infrastructures\persistences;

use domain\models\entities\Livre;

class FileLivreRepository implements LivreRepository
{
    private string $livresFile;

    public function __construct(string $livresFile)
    {
        $this->livresFile = $livresFile;
    }

    private function readCsv(): array
    {
        if (!file_exists($this->livresFile)) {
            return [];
        }

        $lines = array_map('str_getcsv', file($this->livresFile));
        $livres = [];

        foreach ($lines as $line) {
            [$id, $titre, $disponible] = $line;
            $livres[] = new Livre($id, $titre, filter_var($disponible, FILTER_VALIDATE_BOOLEAN));
        }

        return $livres;
    }

    private function writeCsv(array $livres): void
    {
        $lines = [];

        foreach ($livres as $livre) {
            $lines[] = [$livre->getId(), $livre->getTitre(), $livre->isDisponible()];
        }

        $file = fopen($this->livresFile, 'w');

        foreach ($lines as $line) {
            fputcsv($file, $line);
        }

        fclose($file);
    }

    public function nextIdentity(): int
    {
        $livres = $this->readCsv();
        return count($livres) + 1;
    }

    public function save($livre): void
    {
        // Ajouter le nouveau livre dans la source de données (le fichier CSV)
        $livres = $this->readCsv();
        $livres[$livre->getId()->getId()] = $livre;
        $this->writeCsv($livres);
    }

    public function findById($livreId): ?Livre
    {
        $livres = $this->readCsv();
        return $livres[$livreId->getId()] ?? null;
    }


    public function findAll(): array
    {
        return $this->readCsv();
    }
}
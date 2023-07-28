<?php

namespace infrastructures\persistences;

use domain\models\entities\Emprunt;

class FileEmpruntRepository implements EmpruntRepository
{
    private string $empruntsFile;

    public function __construct(string $empruntsFile)
    {
        $this->empruntsFile = $empruntsFile;
    }

    private function readCsv(): array
    {
        if (!file_exists($this->empruntsFile)) {
            return [];
        }

        $lines = array_map('str_getcsv', file($this->empruntsFile));
        $emprunts = [];

        foreach ($lines as $line) {
            [$livreId, $membreId, $dateEmprunt, $dateRetour] = $line;
            $emprunts[] = new Emprunt($livreId, $membreId, $dateEmprunt, $dateRetour);
        }

        return $emprunts;
    }

    private function writeCsv(array $emprunts): void
    {
        $lines = [];

        foreach ($emprunts as $emprunt) {
            $lines[] = [$emprunt->getLivreId(), $emprunt->getMembreId(), $emprunt->getDateEmprunt()->format('Y-m-d'), $emprunt->getDateRetour()->format('Y-m-d')];
        }

        $file = fopen($this->empruntsFile, 'w');

        foreach ($lines as $line) {
            fputcsv($file, $line);
        }

        fclose($file);
    }
    public function nextIdentity(): int
    {
        $emprunts = $this->readCsv();
        return count($emprunts) + 1;
    }

    public function save(Emprunt $emprunt): void
    {
        $emprunts = $this->readCsv();
        $emprunts[] = $emprunt;
        $this->writeCsv($emprunts);
    }

    public function findEmpruntByLivreId($livreId): ?Emprunt
    {
        $emprunts = $this->readCsv();

        foreach ($emprunts as $emprunt) {
            if ($emprunt->getLivreId()->equals($livreId)) {
                return $emprunt;
            }
        }

        return null;
    }

    public function findEmpruntByMembreId($membreId): ?Emprunt
    {
        $emprunts = $this->readCsv();

        foreach ($emprunts as $emprunt) {
            if ($emprunt->getMembreId()->equals($membreId)) {
                return $emprunt;
            }
        }

        return null;
    }

    public function findAllEmprunts(): array
    {
        return $this->readCsv();
    }
}
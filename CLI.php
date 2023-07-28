<?php

use infrastructures\persistences\FileEmpruntRepository;
use infrastructures\persistences\FileLivreRepository;
use infrastructures\persistences\FileMembreRepository;

require_once 'vendor/autoload.php';


// Fichiers de persistance (ici en CSV)
$livresFile = 'livres.csv';
$membresFile = 'membres.csv';
$empruntsFile = 'emprunts.csv';

// Création des repositories
$livreRepository = new FileLivreRepository($livresFile);
$membreRepository = new FileMembreRepository($membresFile);
$empruntRepository = new FileEmpruntRepository($empruntsFile);

// Services d'application
$livreApplicationService = new LivreApplicationService($livreRepository);
$membreApplicationService = new MembreApplicationService($membreRepository);
$empruntApplicationService = new EmpruntApplicationService($empruntRepository, $eventDispatcher);

// Code CLI pour interagir avec l'application
echo "Bienvenue dans la bibliothèque ! Que souhaitez-vous faire ?\n";
echo "1. Voir la liste des livres\n";
echo "2. Voir la liste des membres\n";
echo "3. Voir la liste des livres empruntés\n";
echo "4. Emprunter un livre\n";
echo "5. Retourner un livre\n";
echo "Choisissez une option (1-5) : ";

$choice = (int) readline();

switch ($choice) {
    case 1:
        // Voir la liste des livres
        $livres = $livreApplicationService->getLivres();
        foreach ($livres as $livre) {
            echo "ID: " . $livre->getId() . ", Titre: " . $livre->getTitre() . ", Disponible: " . ($livre->isDisponible() ? "Oui" : "Non") . "\n";
        }
        break;
    case 2:
        // Voir la liste des membres
        $membres = $membreApplicationService->getMembres();
        foreach ($membres as $membre) {
            echo "ID: " . $membre->getId() . ", Nom: " . $membre->getNom() . "\n";
        }
        break;
    case 3:
        // Voir la liste des livres empruntés
        $emprunts = $empruntApplicationService->getEmprunts();
        foreach ($emprunts as $emprunt) {
            $livre = $livreApplicationService->getLivreById($emprunt->getLivreId());
            $membre = $membreApplicationService->getMembreById($emprunt->getMembreId());
            echo "Livre: " . $livre->getTitre() . ", Emprunté par: " . $membre->getNom() . ", Date d'emprunt: " . $emprunt->getDateEmprunt()->format('Y-m-d') . ", Date de retour: " . $emprunt->getDateRetour()->format('Y-m-d') . "\n";
        }
        break;
    case 4:
        // Emprunter un livre
        echo "Veuillez saisir l'ID du livre à emprunter : ";
        $livreId = new LivreId((int) readline());

        echo "Veuillez saisir l'ID du membre emprunteur : ";
        $membreId = new MembreId((int) readline());

        $empruntApplicationService->emprunterLivre($livreId, $membreId);
        echo "Le livre a été emprunté avec succès !\n";
        break;
    case 5:
        // Retourner un livre
        echo "Veuillez saisir l'ID du livre à retourner : ";
        $livreId = new LivreId((int) readline());

        $empruntApplicationService->retournerLivre($livreId);
        echo "Le livre a été retourné avec succès !\n";
        break;
    default:
        echo "Option invalide. Veuillez choisir une option valide (1-5).\n";
}
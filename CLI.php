<?php

require __DIR__.'/vendor/autoload.php';


use infrastructures\events\EventDispatcher;
use infrastructures\events\EventType;
use infrastructures\events\LivreEmprunteEventListener;
use infrastructures\persistences\EmpruntRepository;
use services\EmpruntApplicationService;
use services\EmpruntService;

$empruntRepository = new EmpruntRepository(__DIR__.'/emprunts.txt'); //Ajout de la persistence dans un fichier txt du bled
$eventDispatcher = new EventDispatcher();
$empruntService = new EmpruntService($empruntRepository);
$empruntApplicationService = new EmpruntApplicationService($empruntService, $eventDispatcher);

// Ajout d'un écouteur d'événement pour le type "LIVRE_EMPRUNTE"
$livreEmprunteEventListener = new LivreEmprunteEventListener();
$eventDispatcher->addListener(EventType::LIVRE_EMPRUNTE, $livreEmprunteEventListener);

// Scénario d'emprunt de livre
$empruntApplicationService->emprunterLivre('membre_1', 'livre_1', new \DateTimeImmutable());

// Scénario de rendu de livre
$emprunt = $empruntRepository->findById('emprunt_1');
if ($emprunt) {
    $empruntApplicationService->rendreLivre('emprunt_1', new \DateTimeImmutable());
} else {
    echo "Emprunt introuvable.";
}

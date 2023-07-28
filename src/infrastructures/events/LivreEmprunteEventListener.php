<?php

namespace infrastructures\events;


class LivreEmprunteEventListener implements EventListenerInterface
{
    public function handle($event): void
    {
        if ($event instanceof LivreEmprunteEvent) {
            // Ici, vous pouvez réagir à l'événement LivreEmprunteEvent, par exemple enregistrer un log, envoyer un email, etc.
            echo "Livre emprunté : Livre ID - " . $event->getLivreId() . ", Membre ID - " . $event->getMembreId() . ", Date d'emprunt - " . $event->getDateEmprunt()->format('Y-m-d') . "\n";
        }
    }
}
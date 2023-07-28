<?php

namespace infrastructures\events;


use infrastructures\persistences\LivreRepository;
use infrastructures\persistences\MembreRepository;

class LivreEmprunteEventListener implements EventListenerInterface
{
    private LivreRepository $livreRepository;
    private MembreRepository $membreRepository;

    public function __construct(LivreRepository $livreRepository, MembreRepository $membreRepository)
    {
        $this->livreRepository = $livreRepository;
        $this->membreRepository = $membreRepository;
    }
    public function handle($event): void
    {
        if ($event instanceof LivreEmprunteEvent) {
            $livreId = $event->getLivreId();
            $membreId = $event->getMembreId();
            $dateEmprunt = $event->getDateEmprunt();
        }

        //Dans un futur alternatif kiki recevra des mails grâce au code qui manque ici.
    }
}
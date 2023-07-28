<?php
//ToDo: AGGREGATE ROOT

namespace domain\models;

use DateTimeImmutable;

class Emprunt
{
    private int $id;
    private Membre $membre;
    private Livre $livre;
    private DateTimeImmutable $dateEmprunt;
    private DateTimeImmutable $dateRetour;

    public function __construct(
        string $id,
        Membre $membre,
        Livre $livre,
        \DateTimeImmutable $dateEmprunt
    ) {
        $this->id = $id;
        $this->membre = $membre;
        $this->livre = $livre;
        $this->dateEmprunt = $dateEmprunt;
    }

    public function rendreLivre(\DateTimeImmutable $dateRetour)
    {
        // Valider la date de retour
        // Émettre l'événement LivreRenduEvent

        $this->dateRetour = $dateRetour;
    }

    /**
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * @return DateTimeImmutable
     */
    public function getDateEmprunt(): DateTimeImmutable
    {
        return $this->dateEmprunt;
    }

    /**
     * @return DateTimeImmutable
     */
    public function getDateRetour(): DateTimeImmutable
    {
        return $this->dateRetour;
    }

    /**
     * @return Livre
     */
    public function getLivre(): Livre
    {
        return $this->livre;
    }

    /**
     * @return Membre
     */
    public function getMembre(): Membre
    {
        return $this->membre;
    }
}

<?php

namespace domain\models;

class Livre
{
    private int $id;
    private string $titre;

    public function __construct(int $id, string $titre)
    {
        $this->id = $id;
        $this->titre = $titre;
    }

    /**
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * @return string
     */
    public function getTitre(): string
    {
        return $this->titre;
    }
}

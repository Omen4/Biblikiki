<?php

use domain\models\entities\Livre;
use domain\models\valueObjects\LivreId;
use PHPUnit\Framework\TestCase;

class LivreTest extends TestCase
{
    public function testLivreIsDisponibleByDefault()
    {
        $livreId = new LivreId(1);
        $livre = new Livre($livreId, 'Titre du livre');

        $this->assertTrue($livre->isDisponible());
    }

    public function testEmprunterLivreChangesDisponibilite()
    {
        $livreId = new LivreId(1);
        $livre = new Livre($livreId, 'Titre du livre');

        $livre->emprunter();

        $this->assertFalse($livre->isDisponible());
    }

    public function testRetournerLivreChangesDisponibilite()
    {
        $livreId = new LivreId(1);
        $livre = new Livre($livreId, 'Titre du livre');

        $livre->emprunter();
        $livre->retourner();

        $this->assertTrue($livre->isDisponible());
    }
}
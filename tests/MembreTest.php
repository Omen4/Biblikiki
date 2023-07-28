<?php

use domain\models\entities\Membre;
use domain\models\valueObjects\MembreId;
use PHPUnit\Framework\TestCase;

class MembreTest extends TestCase
{
    public function testMembreHasUniqueId()
    {
        $membreId1 = new MembreId(1);
        $membreId2 = new MembreId(2);

        $membre1 = new Membre($membreId1, 'John Doe');
        $membre2 = new Membre($membreId2, 'Jane Smith');

        $this->assertNotEquals($membreId1->getId(), $membreId2->getId());
    }
}
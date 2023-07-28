<?php


use domain\models\valueObjects\LivreId;
use domain\models\valueObjects\MembreId;
use infrastructures\events\EventDispatcher;
use infrastructures\persistences\EmpruntRepository;
use infrastructures\persistences\LivreRepository;
use PHPUnit\Framework\TestCase;
use services\EmpruntApplicationService;

class EmpruntApplicationServiceTest extends TestCase
{
    /**
     * @throws \PHPUnit\Framework\MockObject\Exception
     * @throws Exception
     */
    public function testEmprunterLivreChangesLivreDisponibilite()
    {
        $livreId = new LivreId(1);
        $membreId = new MembreId(1);

        $livreRepositoryMock = $this->createMock(LivreRepository::class);
        $livreRepositoryMock->method('findById')->willReturn(true);

        $empruntRepositoryMock = $this->createMock(EmpruntRepository::class);
        $empruntRepositoryMock->method('save')->willReturn(true);

        $eventDispatcherMock = $this->createMock(EventDispatcher::class);
        $eventDispatcherMock->method('dispatch')->willReturn(true);

        $empruntApplicationService = new EmpruntApplicationService($empruntRepositoryMock, $livreRepositoryMock, $eventDispatcherMock);

        $empruntApplicationService->emprunterLivre($livreId, $membreId);
    }
}


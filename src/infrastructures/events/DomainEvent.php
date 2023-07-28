<?php

namespace infrastructures\events;

use DateTimeImmutable;

abstract class DomainEvent
{
    protected DateTimeImmutable $occurredOn;

    public function __construct()
    {
        $this->occurredOn = new DateTimeImmutable();
    }

    public function occurredOn(): DateTimeImmutable
    {
        return $this->occurredOn;
    }
}
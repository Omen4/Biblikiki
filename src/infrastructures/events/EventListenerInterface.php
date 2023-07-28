<?php

namespace infrastructures\events;

interface EventListenerInterface
{
    public function handle(DomainEvent $event);
}
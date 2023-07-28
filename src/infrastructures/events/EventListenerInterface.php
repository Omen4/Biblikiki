<?php

namespace infrastructures\events;

interface EventListenerInterface
{
    public function handle(AbstractDomainEvent $event);
}
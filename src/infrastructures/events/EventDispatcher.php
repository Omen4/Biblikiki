<?php

namespace  infrastructures\events;

class EventDispatcher
{
    private array $listeners = [];

    public function addListener(string $eventType, EventListenerInterface $listener): void
    {
        $this->listeners[$eventType][] = $listener;
    }

    public function dispatch(DomainEvent $event): void
    {
        $eventType = get_class($event);
        if (isset($this->listeners[$eventType])) {
            foreach ($this->listeners[$eventType] as $listener) {
                $listener->handle($event);
            }
        }
    }
}

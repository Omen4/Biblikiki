<?php

namespace infrastructures\events;

abstract class EventType
{
    //Impératif pour limiter et structurer le nombre d'events crées
    public const LIVRE_EMPRUNTE = 'livre_emprunte';
    public const LIVRE_RENDU = 'livre_rendu';

}
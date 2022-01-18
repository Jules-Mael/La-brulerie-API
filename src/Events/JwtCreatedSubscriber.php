<?php

namespace App\Events;

use App\Entity\Client;
use App\Entity\Employe;
use Lexik\Bundle\JWTAuthenticationBundle\Event\JWTCreatedEvent;

class JwtCreatedSubscriber {

    public function onJwtCreated(JWTCreatedEvent $createdEvent) {

        $user = $createdEvent->getUser();

        $payload = $createdEvent->getData();
        $payload["role"] = $user->getRoles();

        if ($user instanceof Employe) $payload["rolePower"] = $user->getIdRole();
        else $payload["rolePower"] = 0;

        $createdEvent->setData($payload);
    }
}
<?php

namespace App\Events;

use App\Entity\Client;
use App\Entity\Employe;
use Lexik\Bundle\JWTAuthenticationBundle\Event\JWTCreatedEvent;

class JwtCreatedSubscriber {

    public function onJwtCreated(JWTCreatedEvent $createdEvent) {

        $user = $createdEvent->getUser();

        $payload = $createdEvent->getData();

        if ($user instanceof Employe) $payload["idRole"] = $user->getIdRole()->getIdRole();
        else $payload["idRole"] = 0;

        $createdEvent->setData($payload);
    }
}
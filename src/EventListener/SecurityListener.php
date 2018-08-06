<?php
/**
 * Created by PhpStorm.
 * User: emilien
 * Date: 06/08/2018
 * Time: 22:06
 */

namespace App\EventListener;

use Symfony\Component\Security\Http\Event\InteractiveLoginEvent;

class SecurityListener
{
    /**
     * @param InteractiveLoginEvent $event
     * @return mixed
     */
    public function onSecurityInteractiveLogin(InteractiveLoginEvent $event)
    {
        return
            $event->getRequest()
                ->getSession()
                ->getFlashBag()
                ->add('success',
                    'Boujour ' . $event->getAuthenticationToken()->getUser()->getName().' '.
                    $event->getAuthenticationToken()->getUser()->getSurname(). ' passez une bonne journée !'
                )
            ;
    }
}
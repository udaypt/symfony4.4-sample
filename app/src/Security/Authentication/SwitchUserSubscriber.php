<?php
namespace App\Security\Authentication;

use Symfony\Component\Security\Http\Event\SwitchUserEvent;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
// use Symfony\Component\Security\Core\Event\AuthenticationEvent;
use Symfony\Component\Security\Core\AuthenticationEvents;
use Symfony\Component\Security\Http\SecurityEvents;

class SwitchUserSubscriber implements EventSubscriberInterface
{
	private SessionInterface $session;

	public function __construct(SessionInterface $session)
	{
		$this->session = $session;
	}

	public function onSwitchUser(SwitchUserEvent $event)
	{
		$this->session->remove('onlogout-notice');
		$this->session->set('onswitch-user-notice', '<span style="color: green;">User has been switched to <b>' . $event->getTargetUser()->getUsername() . '</b> successfully.</span>');
		
	}

	public static function getSubscribedEvents(): array
    {
        return [
            SecurityEvents::SWITCH_USER => 'onSwitchUser',
        ];
    }
}

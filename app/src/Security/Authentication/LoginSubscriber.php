<?php
namespace App\Security\Authentication;

use Symfony\Component\Security\Http\Event\DeauthenticatedEvent;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Symfony\Component\Security\Core\Event\AuthenticationEvent;
use Symfony\Component\Security\Core\AuthenticationEvents;

class LoginSubscriber implements EventSubscriberInterface
{
	private SessionInterface $session;

	public function __construct(SessionInterface $session)
	{
		$this->session = $session;
	}

	public function onLoginSuccess(AuthenticationEvent $event)
	{
		$this->session->remove('onlogout-notice');
		$this->session->set('onlogin-notice', '<span style="color: green;">You have been logged in successfully.</span>');
		
	}

	public static function getSubscribedEvents(): array
    {
        return [
            AuthenticationEvents::AUTHENTICATION_SUCCESS => 'onLoginSuccess',
        ];
    }
}

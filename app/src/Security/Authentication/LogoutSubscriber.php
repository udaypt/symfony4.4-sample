<?php
namespace App\Security\Authentication;

use Symfony\Component\Security\Http\Event\DeauthenticatedEvent;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\HttpFoundation\Session\SessionInterface;

class LogoutSubscriber implements EventSubscriberInterface
{
	private SessionInterface $session;

	public function __construct(SessionInterface $session)
	{
		$this->session = $session;
	}

	public function onLogout(DeauthenticatedEvent $event)
	{
		$token = $event->getOriginalToken();
		$this->session->remove('onlogin-notice');
		$this->session->set('onlogout-notice', '<span style="color: green;">Thank you '. $token->getUsername() . ' for using this application.</span>');
	}

	public static function getSubscribedEvents(): array
    {
        return [
            DeauthenticatedEvent::class => 'onLogout',
        ];
    }
}
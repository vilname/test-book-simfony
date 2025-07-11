<?php

declare(strict_types=1);

namespace App\EventSubscriber;

use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Event\RequestEvent;
use Symfony\Component\HttpKernel\KernelEvents;

class AdminSubscriber implements EventSubscriberInterface
{

    public static function getSubscribedEvents(): array
    {
        return [
            KernelEvents::REQUEST => ['onKernelRequest', 0],
        ];
    }

    public function onKernelRequest(RequestEvent $event): void
    {
        $request = $event->getRequest();

        if (str_starts_with($request->getPathInfo(), '/admin')) {
            if ($request->headers->get('X-API-User-Name') !== getenv('HEADER_ADMIN')) {
                $response = new Response(
                    'Admin access denied',
                    Response::HTTP_FORBIDDEN
                );

                $event->setResponse($response);
                return;
            }
        }
    }
}

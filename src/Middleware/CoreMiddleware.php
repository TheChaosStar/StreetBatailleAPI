<?php

namespace App\Middleware;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Event\RequestEvent;

class CoreMiddleware
{
    public function onKernelRequest(RequestEvent $event)
    {
        $request = $event->getRequest();

        if ($request->headers->has("Origin")) {
            $responseHeaders['Access-Control-Allow-Origin'] = $request->headers->has("Origin");
            $responseHeaders['Access-Control-Allow-Credencials'] = 'true';
            $responseHeaders['Access-Control-Allow-Headers'] = 'Authorisation';
            $responseHeaders['Access-Control-Allow-Methods'] = 'POST, GET'; 
        }

        $event->setResponse(new Response('', Response::HTTP_OK, $responseHeaders, true));

    }
}
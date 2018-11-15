<?php

namespace App\Controller;


use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class DefaultController extends Controller
{


    public function index(Request $request): Response
    {
        $name = $request->query->get('nom', 'tout le monde'); // $_GET

        $formData = $request->request->get('nom-du-champs');// $_POST

        $uri = $request->server->get('REQUEST_URI');

        $response = new Response();

        $response->setContent('<h1>Hello ' . $name . '!</h1></body>');

        $response->setStatusCode(Response::HTTP_PARTIAL_CONTENT);

        $response->headers->set('Content-Type', 'text/html');
        $response->headers->set('X-Formation', 'contenu perso');

        return $response;
    }

    public function hello(string $name)
    {
        return $this->render('Default/hello.html.twig', ['name' => $name]);
    }
}

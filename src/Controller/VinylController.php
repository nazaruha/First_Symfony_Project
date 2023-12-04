<?php

namespace App\Controller;

use Symfony\Component\HttpFoundation\Response; // for http responses
use Symfony\Component\Routing\Annotation\Route; // for route attributes
use function Symfony\Component\String\u; // for u

// for routes attributes

class VinylController
{
    #[Route('/')]
    public function index() : Response // return type
    {
        return new Response("Title: PB and Jams");
    }

    #[Route("/browse/{genre}/{author}")]
    public function browse(string $author = null, string $genre = null) : Response // all the types are not necessary but code looks clearer
    {
        if (isset($genre) && isset($author))
        {
            $title = 'Genre: ' . u(str_replace('-', ' ', $genre))->title(true); // str_replace -> replace '-' into ' ', title(true) -> capitalize first letters of each word
            $title = $title . "<br/>Author: $author";
        }
        else
        {
            $title = "All Genres";
        }
        return new Response($title);
    }

}
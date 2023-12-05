<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response; // for http responses
use Symfony\Component\Routing\Annotation\Route; // for route attributes
use function Symfony\Component\String\u; // for u

// for routes attributes

class VinylController extends AbstractController // this parent class gives us a shortcut methods
{
    #[Route('/')]
    public function index() : Response // return type
    {
        $tracks = [ // array of tracks
            ["song" => "Gangsta\'s Paradise", "artist" => "Coolio"],
            ["song" => "Waterfalls", "artist" => "TLC"],
            ["song" => "Creep", "artist" => "Radiohead"],
            ["song" => "Kiss from a Rose", "artist" => "Seal"],
            ["song" => "On Bended Knee", "artist" => "Boyz II Men"],
            ["song" => "Fantasy", "artist" => "Mariah Carey"]
        ];

        return $this->render('vinyl/index.html.twig', [
            /*variables that we want to pass into the template*/
            "title" => "PB & Jams",
            "tracks" => $tracks,
        ]);
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
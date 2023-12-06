<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response; // for http responses
use Symfony\Component\Routing\Annotation\Route; // for route attributes
use Twig\Environment;
use function Symfony\Component\String\u; // for u

// for routes attributes

class VinylController extends AbstractController // this parent class gives us a shortcut methods
{
    #[Route('/', name: "app_homepage")]
    public function index(Environment $twig) : Response // return type
    {
        $tracks = [ // array of tracks
            ["song" => "Gangsta\'s Paradise", "artist" => "Coolio"],
            ["song" => "Waterfalls", "artist" => "TLC"],
            ["song" => "Creep", "artist" => "Radiohead"],
            ["song" => "Kiss from a Rose", "artist" => "Seal"],
            ["song" => "On Bended Knee", "artist" => "Boyz II Men"],
            ["song" => "Fantasy", "artist" => "Mariah Carey"]
        ];
        // Dump and Die -> dd
        //dd($tracks); // get the variable's value on the webpage. LIKE DEBUGGING (need 'debug' recipe)
        dump($tracks);
        //dump(); // ERROR. Only works in Twig files to output all vars that were passed

        $html = $twig->render('vinyl/index.html.twig' /*searches path in the /templates dir*/, [
            /*variables that we want to pass into the template*/
            "title" => "PB & Jams",
            "tracks" => $tracks,
        ]);

        return new Response($html);
    }

    #[Route("/browse/{genre}/{author}", name:'app_browse')]
    public function browse(string $author = null, string $genre = null) : Response // all the types are not necessary but code looks clearer. And their order is not necessary
    {
//        if (isset($genre) && isset($author))
//        {
//            $title = 'Genre: ' . u(str_replace('-', ' ', $genre))->title(true); // str_replace -> replace '-' into ' ', title(true) -> capitalize first letters of each word
//            $title = $title . "<br/>Author: $author";
//        }
//        else
//        {
//            $title = "All Genres";
//        }
//        return new Response($title);

        $genre = $genre ? u(str_replace('-', ' ', $genre))->title(true) : null;
        return $this->render("vinyl/browse.html.twig", [
            "genre" => $genre,
        ]);
    }

}
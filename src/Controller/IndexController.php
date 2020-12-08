<?php

namespace App\Controller;

use App\Entity\Album;
use App\Entity\Artist;
use App\Repository\AlbumRepository;
use App\Repository\ArtistRepository;
use App\Service\SearchMotor;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class IndexController extends AbstractController
{
    /**
     * @Route("/", name="index")
     */
    public function albums(AlbumRepository $albumRepository): Response
    {
        $albums = $albumRepository->findTop(Album::MAX_TOP);
        return $this->render('index/albums.html.twig', [
            "albums" => $albums,
            "sublink" => true,
        ]);
    }

    /**
     * @Route("/artistes", name="artistes")
     */
    public function artistes(ArtistRepository $artistRepository): Response
    {
        $artists = $artistRepository->findAll();
        return $this->render('index/artistes.html.twig', [
            "artistes" => $artists,
            "sublink" => true
        ]);
    }

    /**
     * @Route("/artiste/{slug}", name="artiste_one")
     */
    public function artiste(Artist $artist): Response
    {
        return $this->render('index/artiste.html.twig', [
            "artiste" => $artist,
            "sublink" => false
        ]);
    }

    /**
     * @Route("/search", name="search")
     */
    public function search(Request $request, SearchMotor $searchMotor): Response
    {
        $value = $request->query->get('value');
        return $this->render('index/search.html.twig', [
            "infos" => $searchMotor->getValues($value),
            "search_word" => $value
        ]);
    }
}

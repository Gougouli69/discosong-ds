<?php


namespace App\Service;


use App\Repository\AlbumRepository;
use App\Repository\ArtistRepository;

class SearchMotor
{

    private $artistRepo;
    private $albumRepo;


    public function __construct(ArtistRepository $artistRepository, AlbumRepository $albumRepository)
    {
        $this->artistRepo = $artistRepository;
        $this->albumRepo = $albumRepository;
    }

    public function getValues($searchWord){
        return [
            "artists" => $this->searchArtiste($searchWord),
            "albums" => $this->searchAlbum($searchWord),
        ];
    }

    public function searchArtiste($searchWord){
        return $this->artistRepo->search($searchWord);
    }

    public function searchAlbum($searchWord){
        return $this->albumRepo->search($searchWord);

    }
}

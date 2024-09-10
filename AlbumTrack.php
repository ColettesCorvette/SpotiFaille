<?php

class AlbumTrack
{
    public string $titre;
    public string $artiste;
    public string $album;
    public string $annee;
    public int $numeroPiste;
    public string $genre;
    public int $duree;
    public string $nomFichier;

    public function __construct(string $t, string $f) 
    {
        $this->titre =$t;
        $this->nomFichier=$f;
    }

    public function __toString():string
    {
        return json_encode($this);
    }
}
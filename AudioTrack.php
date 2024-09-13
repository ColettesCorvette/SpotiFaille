<?php

declare(strict_types=1);

abstract class AudioTrack
{
    public string $artiste;
    public string $titre;
    public string $genre;
    public int $duree;
    public string $nomFichier;
   
    public function __construct(
        string $a,
        string $t,
        string $g,
        int $d,
        string $f
    )
    
    {
        $this->artiste=$a;
        $this->titre=$t;
        $this->genre=$g;
        $this->duree=$d;
        $this->nomFichier=$f;
    }
}
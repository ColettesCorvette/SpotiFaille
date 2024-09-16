<?php

declare(strict_types=1);

abstract class AudioTrack
{
    public string $auteur;
    public string $titre;
    public string $genre;
    public int $duree;
    public string $nomFichier;
    public int $numero;
   
    public function __construct(
        string $a,
        string $t,
        string $g,
        int $d,
        string $f,
        int $num
    )
    
    {
        $this->auteur=$a;
        $this->titre=$t;
        $this->genre=$g;
        $this->duree=$d;
        $this->nomFichier=$f;
        $this->numero=$num;
    }
}
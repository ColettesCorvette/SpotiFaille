<?php

declare(strict_types=1);

abstract class AudioTrack
{
    protected string $auteur;
    protected string $titre;
    protected string $genre;
    protected int $duree;
    protected string $nomFichier;
    protected int $numero;
   
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
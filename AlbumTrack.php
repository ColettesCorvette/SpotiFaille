<?php

declare(strict_types=1);

class AlbumTrack extends AudioTrack
{
    public string $album;
    public string $annee;
  
    public function __construct(
        string $auteur, 
        string $al,
        string $an,
        string $t, string $g, 
        int $d, string $f, int $numPiste
        ) 
    {   
        parent::__construct($auteur,$t,$g,$d,$f,$numPiste);
        $this->album =$al;
        $this->annee=$an;   
    }
}
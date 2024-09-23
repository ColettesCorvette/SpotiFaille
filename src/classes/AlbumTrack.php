<?php

declare(strict_types=1);

namespace iutnc\deefy\audio\tracks;

class AlbumTrack extends AudioTrack
{
    protected string $album;
    protected string $annee;
  
    public function __construct(
        string $artiste, 
        string $al,
        string $an,
        string $t, string $g, 
        int $d, string $f, int $numPiste
        ) 
    {   
        parent::__construct($artiste,$t,$g,$d,$f,$numPiste);
        $this->album =$al;
        $this->annee=$an;   
    }
}
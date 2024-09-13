<?php

declare(strict_types=1);

require_once __DIR__ . "/AudioTrack.php";



class AlbumTrack extends AudioTrack
{
    public string $album;
    public string $annee;
    public int $numeroPiste;
  
    public function __construct(
        string $artiste, 
        string $al,
        string $an, int $n,
        string $t, string $g, 
        int $d, string $f
        ) 
    {   
        parent::__construct($artiste,$t,$g,$d,$f);
        $this->album =$al;
        $this->annee=$an;
        $this->numeroPiste=$n;   
    }

    public function __toString()
    {
        return json_encode($this);
    }
}
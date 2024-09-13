<?php

declare(strict_types=1);

class AlbumTrack extends AudioTrack
{
    public string $artiste;
    public string $album;
    public string $annee;
    public int $numeroPiste;
  
    public function __construct(string $t, string $f) 
    {
        $this->titre =$t;
        $this->nomFichier=$f;
    }

    public function __toString()
    {
        return json_encode($this);
    }
}
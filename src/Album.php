<?php

class Album extends AudioList
{

    private string $artiste;
    private string $sortie; 

    public function __construct(string $artiste, string $sortie,string $nom, array $liste)
    {
        parent::__construct($nom, $liste);
        $this->artiste=$artiste;
        $this->sortie=$sortie;
    }

    public function setArtiste(string $a): void
    {
        $this->artiste = $a;
    }

    public function setSortie(string $s): void
    {
        $this->sortie = $s;
    }
}
<?php

class Album extends AudioList
{

    protected string $artiste;
    protected string $sortie; 

    public function __construct(
        string $a, string $s,string $n, int $nPistes, int $dureeTle,
        array $liste
    )
    {
        parent::__construct($n,$nPistes,$dureeTle, $liste);
        $this->artiste=$a;
        $this->sortie=$s;
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
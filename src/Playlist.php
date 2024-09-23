<?php

class Playlist extends AudioList
{
        
    public function __construct(string $n, array $listePistes)
    {
        parent::__construct($n, $listePistes);
    }

    public function ajout(AudioTrack $track): void
    {   
        $this->listePistes[] = $track;
        $this->nombrePistes++;
        $this->dureeTotale+=$track->duree;
    }

    public function suppression(int $index)
    {
        if (isset($this->listePistes[$index])) {
            $this->dureeTotale -= $this->listePistes[$index]->duree;
            unset($this->listePistes[$index]);
            $this->listePistes = array_values($this->listePistes); 
            $this->nombrePistes--;
        }
    }

    public function ajoutListe(array $tracks): void
    {
        foreach ($tracks as $track) {
            if (!in_array($track, $this->listePistes, true)) {
                $this->ajout($track);
            }
        }
    }
}
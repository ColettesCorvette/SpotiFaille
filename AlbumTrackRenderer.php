<?php

declare(strict_types=1);

class AlbumTrackRenderer
{
    public AlbumTrack $track;

    public function __construct(AlbumTrack $t)
    {
        $this->track = $t;
    }

    public function render(int $selector): string
    {
        switch ($selector) 
        {
            case 0:
                return $this->renderCompact();
            case 1:
                return $this->renderLong();
            default:
                return "selecteur invalide";
        }
    }
    
    private function renderCompact(): string
    {
        return "<div>
                    <p>{$this->track->titre} - {$this->track->artiste}</p>
                    <audio controls>
                        <source src='{$this->track->nomFichier}' type='audio/mpeg'>
                    </audio>
                </div>";
    }

    private function renderLong(): string
    {
        return "<div>
                    <p>Title: {$this->track->titre}</p>
                    <p>Artist: {$this->track->artiste}</p>
                    <p>Album: {$this->track->album}</p>
                    <p>Year: {$this->track->annee}</p>
                    <p>Track Number: {$this->track->numeroPiste}</p>
                    <p>Genre: {$this->track->genre}</p>
                    <p>Duration: {$this->track->duree} seconds</p>
                    <audio controls>
                        <source src='{$this->track->nomFichier}' type='audio/mpeg'>
                    </audio>
                </div>";
    }

}
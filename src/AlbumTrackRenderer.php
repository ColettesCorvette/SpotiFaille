<?php

declare(strict_types=1);

namespace iutnc\deefy\render;


class AlbumTrackRenderer extends AudioTrackRenderer 
{
    protected AlbumTrack $track;

    public function __construct(AlbumTrack $t)
    {
        $this->track = $t;
    }

    public function render(int $sparam): string
    {   
        
        return parent::render($sparam);
    }
    
    public function renderCompact(): string
    {
        return "<div>
                    <p>" . htmlspecialchars($this->track->titre) . " - " . htmlspecialchars($this->track->auteur) . "</p>
                    " . $this->renderAudio() . "
                </div>";
    }

    public function renderLong(): string
    {
        return "<div>
                    <p>Title: " . htmlspecialchars($this->track->titre) . "</p>
                    <p>Artist: " . htmlspecialchars($this->track->auteur) . "</p>
                    <p>Album: " . htmlspecialchars($this->track->album) . "</p>
                    <p>Year: " . htmlspecialchars($this->track->annee) . "</p>
                    <p>Track Number: " . $this->track->numero . "</p>
                    <p>Genre: " . htmlspecialchars($this->track->genre) . "</p>
                    <p>Duration: " . $this->track->duree . " seconds</p>
                    " . $this->renderAudio() . "
                </div>";
    }

    private function renderAudio(): string
    {
        return "<audio controls>
                    <source src='" . htmlspecialchars($this->track->nomFichier) . "' type='audio/mpeg'>
                </audio>";
    }

}
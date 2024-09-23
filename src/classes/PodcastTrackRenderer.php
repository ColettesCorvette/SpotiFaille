<?php

declare(strict_types=1);

namespace iutnc\deefy\render;

class PodcastTrackRenderer extends AudioTrackRenderer
{
    protected PodcastTrack $podcast;

    public function __construct(PodcastTrack $p)
    {
        $this->podcast=$p;   
    }

    public function render(int $param):string
    {   
        
        return parent::render($param);
    }

    public function renderCompact(): string
    {
        return "<div>
                    <p>" . htmlspecialchars($this->podcast->titre, ENT_QUOTES, 'UTF-8') . " - " . htmlspecialchars($this->podcast->auteur, ENT_QUOTES, 'UTF-8') . "</p>
                    <audio controls>
                        <source src='" . htmlspecialchars($this->podcast->nomFichier, ENT_QUOTES, 'UTF-8') . "' type='audio/mpeg'>
                    </audio>
                </div>";
    }

    public function renderLong(): string
    {
        return "<div>
                    <p>Title: " . htmlspecialchars($this->podcast->titre, ENT_QUOTES, 'UTF-8') . "</p>
                    <p>Auteur: " . htmlspecialchars($this->podcast->auteur, ENT_QUOTES, 'UTF-8') . "</p>
                    <p>Track Number: " . $this->podcast->numero . "</p>
                    <p>Genre: " . htmlspecialchars($this->podcast->genre, ENT_QUOTES, 'UTF-8') . "</p>
                    <p>Duration: " . $this->podcast->duree . " seconds</p>
                    <audio controls>
                        <source src='" . htmlspecialchars($this->podcast->nomFichier, ENT_QUOTES, 'UTF-8') . "' type='audio/mpeg'>
                    </audio>
                </div>";
    }

}
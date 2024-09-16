<?php

declare(strict_types=1);

require_once __DIR__ . "/Renderer.php";
require_once __DIR__ . "/AudioTrack.php";
require_once __DIR__ . "/PodcastTrack.php";


class PodcastTrackRenderer extends AudioTrackRenderer implements Renderer 
{
    public PodcastTrack $podcast;

    public function __construct($podcast)
    {
        $this->podcast=$podcast;   
    }

    public function render(int $param):string
    {
        return parent::render($param);
    }

    public function renderCompact(): string
    {
        return "<div>
                    <p>{$this->track->titre} - {$this->track->artiste}</p>
                    <audio controls>
                        <source src='{$this->track->nomFichier}' type='audio/mpeg'>
                    </audio>
                </div>";
    }

    public function renderLong(): string
    {
        return "<div>
                    <p>Title: {$this->track->titre}</p>
                    <p>Auteur: {$this->track->artiste}</p>
                    <p>Release: {$this->track->annee}</p>
                    <p>Track Number: {$this->track->numeroPiste}</p>
                    <p>Genre: {$this->track->genre}</p>
                    <p>Duration: {$this->track->duree} seconds</p>
                    <audio controls>
                        <source src='{$this->track->nomFichier}' type='audio/mpeg'>
                    </audio>
                </div>";
    }

}
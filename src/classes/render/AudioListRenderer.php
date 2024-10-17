<?php

namespace iutnc\deefy\render;

use iutnc\deefy\audio\lists\AudioList;
use iutnc\deefy\audio\tracks\AlbumTrack;
use iutnc\deefy\audio\tracks\PodcastTrack;

class AudioListRenderer implements Renderer
{
    private AudioList $liste;

    public function __construct(AudioList $liste)
    {
        $this->liste=$liste;
    }

    
    public function render(int $selector=1): string
    {
        $output = "Nom de la liste : " . $this->liste->nom . "\n";
        $output .= "Pistes :\n";

        foreach ($this->liste->listePistes as $index => $piste) {
            if ($piste instanceof AlbumTrack) {
                $renderer = new AlbumTrackRenderer($piste);
            } elseif ($piste instanceof PodcastTrack) {
                $renderer = new PodcastTrackRenderer($piste);
            } else {
                continue; // Skip if the track type is not recognized
            }
            $output .= ($index + 1) . ". " . $renderer->render($selector) . "\n";
        }

        $output .= "Nombre de pistes : " . $this->liste->nombrePistes . "\n";
        $output .= "Durée totale : " . $this->liste->dureeTotale . "s\n";

        return $output;
    }

}
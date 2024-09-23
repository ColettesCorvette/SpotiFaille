<?php

namespace iutnc\deefy\render;

use iutnc\deefy\audio\lists\AudioList;

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

        foreach ($this->liste->listePistes as $index => $piste){
            $output .= ($index + 1) . ". " . $piste->render($selector) . "\n";
        }

        $output .= "Nombre de pistes : " . $this->liste->nbPistes . "\n";
        $output .= "Durée totale : " . $this->liste->dureeTotale . "s\n";

        return $output;
    }

}
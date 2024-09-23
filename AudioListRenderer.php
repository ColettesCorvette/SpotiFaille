<?php 

class AudioListRenderer implements Renderer
{
    private AudioList $liste;

    public function __construct(AudioList $liste)
    {
        $this->liste=$liste;
    }

    public function render(): string
    {
        $output = "Nom de la liste : " . $this->liste->nom . "\n";
        $output .= "Pistes :\n";

        foreach ($this->liste->listePistes as $index => $piste) {
            $output .= ($index + 1) . ". " . $piste->titre . " (" . $piste->duree . "s)\n";
        }

        $output .= "Nombre de pistes : " . $this->liste->nbPistes . "\n";
        $output .= "Durée totale : " . $this->liste->dureeTotale . "s\n";

        return $output;
    }

}
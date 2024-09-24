<?php

declare(strict_types=1);

namespace iutnc\deefy\audio\tracks;


abstract class AudioTrack
{
    protected string $auteur;
    protected string $titre;
    protected string $genre;
    protected int $duree;
    protected string $nomFichier;
    protected int $numero;

    private $properties = [
        "auteur" => "a",
        "titre" => "a",
        "genre" => "a",
        "duree" => 0,
        "nomFichier" => "a",
        "numero" => 0,
        "album" => "a",
        "annee" => "a"
        
    ];
   
    public function __construct(
        string $a,
        string $t,
        string $g,
        int $d,
        string $f,
        int $num
    )
    
    {
        $this->auteur=$a;
        $this->titre=$t;
        $this->genre=$g;
        $this->duree=$d;
        $this->nomFichier=$f;
        $this->numero=$num;
    }


    public function __get($name)
    {
        if (!array_key_exists($name, $this->properties)) {
            return null;
        }
        return $this->$name;
    }

    public function __set($name, $value)
    {
        if (!array_key_exists($name, $this->properties)) {
            return;
        }
        
        switch ($name) {
            case 'auteur':
            case 'titre':
            case 'genre':
            case 'nomFichier':
                if (is_string($value)) {
                    $this->$name = $value;
                }
                break;
            case 'duree':
            case 'numero':
                if (is_int($value) && ($name !== 'duree' || $value >= 0)) {
                    $this->$name = $value;
                }
                break;
        }
    }


}
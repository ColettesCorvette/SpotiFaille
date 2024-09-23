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
            throw new InvalidPropertyNameException("Unknown property: $name");
        }
        return $this->$name;
    }

    public function __set($name, $value)
    {
        if (!array_key_exists($name, $this->properties)) {
            throw new InvalidPropertyNameException("Unknown property: $name");
        }
        
        switch ($name) {
            case 'auteur':
            case 'titre':
            case 'genre':
            case 'nomFichier':
                if (!is_string($value)) {
                    throw new InvalidPropertyValueException("Invalid type for property '$name': expected string");
                }
                break;
            case 'duree':
            case 'numero':
                if (!is_int($value)) {
                    throw new InvalidPropertyValueException("Invalid type for property '$name': expected integer");
                }
                if ($name === 'duree' && $value < 0) {
                    throw new InvalidPropertyValueException("Invalid value for property 'duree': $value");
                }
                break;
            default:
                throw new InvalidPropertyNameException("Unknown property: $name");
        }
        $this->$name = $value;
    }


}
<?php

namespace iutnc\deefy\audio\lists;


abstract class AudioList
{
    protected string $nom;
    protected int $nombrePistes;
    protected int $dureeTotale;
    protected ?array $listePistes; 
    
    public function __construct(string $n,array $lP =[])
    {
        $this->nom=$n;
        $this->nombrePistes=count($lP);
        $this->dureeTotale=array_reduce($lP, function($carry, $item){
            return $carry + $item->duree;
        },0);

        $this->listePistes=$lP;
    }

    public function __get(mixed $var)
    {
        if(property_exists($this, $var))
        {
            return $this->$var;
        }
    }   
}
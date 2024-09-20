<?php

abstract class AudioList
{
    protected string $nom;
    protected int $nombrePistes;
    protected int $dureeTotale;
    private ?array $listePistes; 
    
    public function __construct(
        string $n,
        int $nP,
        int $dT,
        array $lP =[]
    )
    {
        $this->nom=$n;
        $this->nombrePistes=$nP;
        $this->dureeTotale=$dT;
        $this->listePistes=$lP;
    }

    public function __get(mixed $var)
    {
        if(property_exists($this, $var))
        {
            return $this->$var;
        }

        return InvalidPropertyNameValueException("n'existe pas");
    }   

}
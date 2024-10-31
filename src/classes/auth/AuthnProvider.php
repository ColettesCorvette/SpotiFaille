<?php

namespace iutnc\deefy\auth;
use iutnc\deefy\exception\AuthnException;

class AuthnProvider
{
    //Créer la méthode (statique) signin() qui reçoit l'email et le mot de passe en clair d'un utilisateur,
    //et contrôle la validité de ces données.
    //En cas d'échec, la méthode déclenche une exception iutnc\deefy\AuthnException.
    public static function signin(string $email, string $password) : boolean
    {


        return true;
    }

}
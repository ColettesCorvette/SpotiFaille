<?php

    namespace iutnc\deefy\action;

    class DefaultAction extends Action
    {

        public function __construct()
        {
            parent::__construct();
        }
        public function execute(): string
        {
            return "Bienvenue !" . '<br>';
        }
    }
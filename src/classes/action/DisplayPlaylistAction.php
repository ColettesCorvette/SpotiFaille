<?php

namespace iutnc\deefy\action;

use iutnc\deefy\action\Action;
use iutnc\deefy\render\AudioListRenderer;
use iutnc\deefy\render\Renderer;

class DisplayPlaylistAction extends Action
{

    public function __construct()
    {
        parent::__construct();
    }

    public function execute(): string
    {

        if (isset($_SESSION['playlist'])) {
            $playlistRenderer = new AudioListRenderer($_SESSION['playlist']);
            return $playlistRenderer->render(Renderer::LONG);
        } else {
            return "No playlist in session.";
        }

    }
}
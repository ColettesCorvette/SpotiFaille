<?php

namespace iutnc\deefy\action;

use iutnc\deefy\action\Action;
use iutnc\deefy\audio\lists\Playlist;

class AddPlaylistAction extends Action
{

    public function __construct()
    {
        parent::__construct();
    }
    public function execute(): string
    {
        $playlist = new Playlist("Playlist_1", []);
        $_SESSION['playlist'] = serialize($playlist);
        return "Playlist créee et ajoutée à la session.";
    }
}
<?php

namespace iutnc\deefy\action;

use iutnc\deefy\audio\lists\Playlist;
use iutnc\deefy\render\AudioListRenderer;
use iutnc\deefy\render\Renderer;

class AddPlaylistAction extends Action
{

    public function __construct()
    {
        parent::__construct();
    }
    public function execute(): string
    {

        if($_SERVER['REQUEST_METHOD']==='GET')
        {
            return <<<HTML
            <form method="post" action="?action=add-playlist">
                <label for="playlist_name">Nom de la playlist :</label>
                <input type="text" id="playlist_name" name="playlist_name" required>
                <button type="submit">Créer la playlist</button>
            </form>
            HTML;
        }

        if($_SERVER['REQUEST_METHOD']==='POST')
        {
            $playlistName = filter_var($_POST['playlist_name'], FILTER_SANITIZE_SPECIAL_CHARS);
            $playlist = new Playlist($playlistName, []);
            $_SESSION['playlist'] = serialize($playlist);
            $playlistRenderer = new AudioListRenderer($playlist);
            $renderedPlaylist = $playlistRenderer->render(Renderer::LONG);
            return $renderedPlaylist . '<br>'.'<a href="?action=add-track">Ajouter une piste</a>';
        }
        return "Invalid request method.";
    }
}
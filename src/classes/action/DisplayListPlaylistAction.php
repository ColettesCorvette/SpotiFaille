<?php

namespace iutnc\deefy\action;

use iutnc\deefy\action\Action;
use iutnc\deefy\audio\lists\Playlist;
use iutnc\deefy\repository\DeefyRepository;

class DisplayListPlaylistAction extends Action
{

    private array $playlists=[];
    public function __construct()
    {
        parent::__construct();
    }
    public function execute(): string
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['id'])) {
            $playlistId = (int)$_POST['id'];
            $playlist = DeefyRepository::getInstance()->findPlaylistById($playlistId);
            $_SESSION['playlist'] = serialize($playlist);
            return (new DisplayPlaylistAction())->execute();
        } else {
            $playlists = DeefyRepository::getInstance()->getAllPlaylists();
            $playlistArray = [];

            foreach ($playlists as $playlist) {
                $playlistArray[] = [
                    'id' => $playlist->id,
                    'name' => $playlist->nom
                ];
            }

            return $this->renderForm($playlistArray);
        }
    }

    private function renderForm(array $playlistArray): string
    {
        $str = "";
        foreach ($playlistArray as $playlist) {
            $str .= "<form method='post' enctype='multipart/form-data'>
                        <input type='hidden' name='id' value='{$playlist['id']}'>
                        <button type='submit'>{$playlist['name']}</button>
                     </form><br>";
        }
        return $str;
    }

}
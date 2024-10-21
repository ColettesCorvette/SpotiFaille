<?php

namespace iutnc\deefy\action;


use iutnc\deefy\audio\lists\Playlist;
use iutnc\deefy\audio\tracks\PodcastTrack;
use iutnc\deefy\render\AudioListRenderer;
use iutnc\deefy\render\Renderer;

class AddPodcastTrackAction extends Action
{

    public function __construct()
    {
        parent::__construct();
    }

    public function execute(): string
    {


        if($_SERVER['REQUEST_METHOD']==='POST'){


            if(!isset($_FILES['file']) || $_FILES['file']['error']!==UPLOAD_ERR_OK){
                exit("Erreur: Aucun fichier uploadé ou erreur lors de l'upload");
            }

            //recuperer les donnees du formatulaire
            $author = filter_var($_POST['author'], FILTER_SANITIZE_SPECIAL_CHARS);
            $title = filter_var($_POST['title'], FILTER_SANITIZE_SPECIAL_CHARS);
            $genre = filter_var($_POST['genre'], FILTER_SANITIZE_SPECIAL_CHARS);
            $duration = filter_var($_POST['duration'], FILTER_SANITIZE_NUMBER_INT);
            $episodeNumber = filter_var($_POST['episode_number'], FILTER_SANITIZE_NUMBER_INT);
            $audioFile = $_FILES['file']['name'];

            //deplacer le fichier uploadé vers le dossier cible
            $targetDir = "";
            $targetFile = $targetDir . basename($audioFile);
            move_uploaded_file($_FILES['file']['tmp_name'],$targetFile);


            //creer une nouvelle piste
            $podcastTrack = new PodcastTrack($author,$title,$genre,$duration,$targetFile,$episodeNumber);

            //recupérer la playlist de la session
            $playlist= unserialize($_SESSION['playlist']);

            //ajouter la nouvelle piste à la playlist
            $playlist->ajout($podcastTrack);

            //Enregistrer la playlist mise à jour dans la session
            $_SESSION['playlist'] = serialize($playlist);

            //Afficher la playlist mise à jour
            $playlistRenderer = new AudioListRenderer($playlist);
            $html = $playlistRenderer->render(Renderer::LONG);
            $html.='<a href="?action=add-track">Ajouter encore une piste</a>';

            return $html;

        }else{
            return $this->renderForm();
        }
    }
    private function renderForm(): string
    {
        return <<<HTML
        <form method="post" action="?action=add-track" enctype="multipart/form-data">
            <label for="author">Author:</label>
            <input type="text" id="author" name="author" required>
            <label for="title">Title:</label>
            <input type="text" id="title" name="title" required>
            <label for="genre">Genre:</label>
            <input type="text" id="genre" name="genre" required>
            <label for="duration">Duration (seconds):</label>
            <input type="number" id="duration" name="duration" required>
            <label for="episode_number">Episode Number:</label>
            <input type="number" id="episode_number" name="episode_number" required>
            <label for="file">Audio File:</label>
            <input type="file" id="file" name="file" accept=".mp3" required>
            <button type="submit">UPLOAD</button>
        </form>
        HTML;
    }
}
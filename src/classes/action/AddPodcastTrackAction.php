<?php

namespace iutnc\deefy\action;

use iutnc\deefy\action\Action;
use iutnc\deefy\audio\tracks\PodcastTrack;

class AddPodcastTrackAction extends Action
{

    public function __construct()
    {
        parent::__construct();
    }

    public function execute(): string
    {
        if (isset($_SESSION['playlist'])) {
            $podcastTrack = new PodcastTrack("Author", "Title", "Genre", 120, "./path/to/file.mp3", 1);
            $_SESSION['playlist']->ajout($podcastTrack);
            return "Podcast track added to playlist.";
        } else {
            return "No playlist in session.";
        }
    }
}
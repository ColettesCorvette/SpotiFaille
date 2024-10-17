<?php

namespace iutnc\deefy\action;


use iutnc\deefy\audio\tracks\PodcastTrack;
use iutnc\deefy\audio\lists\Playlist;

class AddPodcastTrackAction extends Action
{

    public function __construct()
    {
        parent::__construct();
    }

    public function execute(): string
    {
        if (isset($_SESSION['playlist'])) {
            $pl = unserialize($_SESSION['playlist']);
            $podcastTrack = new PodcastTrack("Author", "Title", "Genre", 120, "./path/to/file.mp3", 1);
            $pl->ajout($podcastTrack);
            $_SESSION['playlist'] = serialize($pl);
            return "Podcast track added to playlist.";
        } else {
            return "No playlist in session.";
        }
    }
}
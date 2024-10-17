<?php

declare(strict_types=1);

error_reporting(E_ALL);
ini_set('display_errors', '1');

session_start();

require_once "vendor/autoload.php";

use iutnc\deefy\action\AddPlaylistAction;
use iutnc\deefy\action\AddPodcastTrackAction;
use iutnc\deefy\action\DefaultAction;
use iutnc\deefy\action\DisplayPlaylistAction;
use iutnc\deefy\audio\tracks\AlbumTrack;
use iutnc\deefy\audio\tracks\PodcastTrack;
use iutnc\deefy\render\AlbumTrackRenderer;
use iutnc\deefy\render\AudioListRenderer;
use iutnc\deefy\render\PodcastTrackRenderer;
use iutnc\deefy\render\Renderer;
use iutnc\deefy\audio\lists\Album;
use iutnc\deefy\audio\lists\Playlist;
use iutnc\deefy\exception\InvalidPropertyNameException;
use iutnc\deefy\exception\InvalidPropertyValueException;
use iutnc\deefy\dispatch\Dispatcher;


try
    {
        $track1 = new AlbumTrack("Jean-Luc","Album","1998","Musique","beauf",120,"URL",1);
        $track2 = new AlbumTrack("Jean-Bidule","Aya","2000","Musique","beauf",120,"URL",1);
        $podcast = new PodcastTrack("Jean-Marc","Podcast","woke",120,"URL",1);

        //$_SESSION["playlist"] = new Playlist("MaPlaylist",[$track1,$podcast]);

        //$_SESSION["playlist"]->ajout($track2);

        //$playlistRenderer = new AudioListRenderer($_SESSION["playlist"]);

        //echo $playlistRenderer->render(Renderer::LONG);

        //$r = new AlbumTrackRenderer($track1);
        //$p = new PodcastTrackRenderer($podcast);

        //echo $r->render(Renderer::LONG);
        //echo $p->render(Renderer::LONG);

        $dispatcher = new Dispatcher();
        $dispatcher->run();

    } catch (Exception $e) {
        echo "Erreur : " . $e->getMessage() . "\n";
        echo $e->getTraceAsString() . "\n";
    }

    

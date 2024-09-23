<?php

declare(strict_types=1);

error_reporting(E_ALL);
ini_set('display_errors', '1');


use iutnc\deefy\audio\tracks\AlbumTrack;
use iutnc\deefy\audio\tracks\PodcastTrack;
use iutnc\deefy\render\AlbumTrackRenderer;
use iutnc\deefy\render\PodcastTrackRenderer;
use iutnc\deefy\render\Renderer;
use iutnc\deefy\exception\InvalidPropertyNameException;
use iutnc\deefy\exception\InvalidPropertyValueException;

require_once "src/classes/Renderer.php";
require_once "src/classes/AudioTrack.php";
require_once "src/classes/AudioTrackRenderer.php";
require_once "src/classes/AlbumTrack.php";
require_once "src/classes/AlbumTrackRenderer.php";
require_once "src/classes/PodcastTrack.php";
require_once "src/classes/PodcastTrackRenderer.php";
require_once "src/classes/InvalidPropertyNameException.php";
require_once "src/classes/InvalidPropertyValueException.php";


try
    {
    $track1 = new AlbumTrack("Jean-Luc","Album","1998","Musique","beauf",120,"audio/01-Im_with_you_BB-King-Lucille.mp3",1);

    $podcast = new PodcastTrack("Jean-Marc","Podcast","woke",120,"audio/02-I_Need_Your_Love-BB_King-Lucille.mp3",1);    

    $r = new AlbumTrackRenderer($track1);
    $p = new PodcastTrackRenderer($podcast);

    
    echo $r->render(Renderer::LONG);
    echo $p->render(Renderer::LONG);

    }catch(Exception $e)
    {
        echo "Exception: " . $e->getMessage() . "\n";
        echo "Trace: " . $e->getTraceAsString() . "\n";
    }
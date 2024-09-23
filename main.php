<?php

declare(strict_types=1);

error_reporting(E_ALL);
ini_set('display_errors', '1');



require_once "Renderer.php";
require_once "AudioTrack.php";
require_once "AudioTrackRenderer.php";
require_once "AlbumTrack.php";
require_once "AlbumTrackRenderer.php";
require_once "PodcastTrack.php";
require_once "PodcastTrackRenderer.php";

require_once "InvalidPropertyNameException.php";
require_once "InvalidPropertyValueException.php";

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
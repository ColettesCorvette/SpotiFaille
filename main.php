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


$track1 = new AlbumTrack("nom","fff","fff","fff","ff",0,"audio/01-Im_with_you_BB-King-Lucille.mp3",0);

$podcast = new PodcastTrack("nom","ff","ff",0,"audio/02-I_Need_Your_Love-BB_King-Lucille.mp3",0);


$r = new AlbumTrackRenderer($track1);
$p = new PodcastTrackRenderer($podcast);
//echo $r->render(0); //mode compact
echo $r->render(Renderer::LONG); //mode long
echo $p->render(Renderer::LONG);
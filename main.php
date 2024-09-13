<?php

declare(strict_types=1);

require_once __DIR__ . "/AlbumTrack.php";
require_once __DIR__ ."/AlbumTrackRenderer.php";
require_once __DIR__ ."/AudioTrack.php";
require_once __DIR__ . "/PodcastTrack.php";




$track1 = new AlbumTrack("Bilbo","album1","2005",3,"titre1","genre1",120,"audio/01-Im_with_you_BB-King-Lucille.mp3");



/*
echo $track1->__toString();
print_r($track1);
var_dump($track1);
*/
$r = new AlbumTrackRenderer($track1);
//echo $r->render(0); //mode compact
echo $r->render(1); //mode long
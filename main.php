<?php

declare(strict_types=1);

require_once "AlbumTrack.php";
require_once "AlbumTrackRenderer.php";

$track1 = new AlbumTrack("track1","path_to_file");


/*
echo $track1->__toString();
print_r($track1);
var_dump($track1);
*/
$r = new AlbumTrackRenderer($track1);
echo $r->render(0); //mode compact
echo $r->render(1); //mode long
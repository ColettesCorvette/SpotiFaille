<?php

declare(strict_types=1);

class PodcastTrack extends AudioTrack
{
    public function __construct(
        string $auteur,
        string $t, string $g, 
        int $d, string $f, int $numEpisode
        )
    {
        parent::__construct($auteur,$t,$g,$d,$f,$numEpisode);   
    }
}
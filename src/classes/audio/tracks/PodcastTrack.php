<?php

declare(strict_types=1);

namespace iutnc\deefy\audio\tracks;

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
<?php

declare(strict_types=1);


class PodcastTrack extends AudioTrack
{
    public function __construct(
        string $auteur,
        string $t, string $g, 
        string $d, string $f
        )
    {
        parent::__construct($auteur,$t,$g,$d,$f);   
    }
}
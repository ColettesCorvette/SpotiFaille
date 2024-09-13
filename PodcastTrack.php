<?php

declare(strict_types=1);


class PodcastTrack extends AudioTrack
{
    
    

    public function __construct(string $a)
    {
        $this->auteur=$a;
    }
}
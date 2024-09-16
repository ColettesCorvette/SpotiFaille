<?php

declare(strict_types=1);


abstract class AudioTrackRenderer implements Renderer
{
    public function render(int $selecteur) : string
    {   

        if($selecteur===Renderer::COMPACT)
            return $this->renderCompact();
        

        if($selecteur===Renderer::LONG)
            return $this->renderLong();
        

        return 0;
    }    
    
    public abstract function renderCompact(): string;
    public abstract function renderLong(): string;
    
}
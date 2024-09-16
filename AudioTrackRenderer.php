<?php

declare(strict_types=1);

abstract class AudioTrackRenderer
{
    public function render(int $selecteur) : string
    {
        switch($selecteur)
        {
            case Renderer::COMPACT:
                return $this->renderCompact();
                break;

            case Renderer::LONG:
                return $this->renderLong();
                break;

        }
    }    
    
    public abstract function renderCompact(): string;
    public abstract function renderLong(): string;
    
}
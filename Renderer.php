<?php

declare(strict_types=1);

interface Renderer
{

    public function render(int $selector):string;

    public const COMPACT = 0;
    public const LONG = 1;


}


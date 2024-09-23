<?php

declare(strict_types=1);

namespace iutnc\deefy\render;

interface Renderer
{
    public const COMPACT = 0;
    public const LONG = 1;

    public function render(int $selector): string;

}


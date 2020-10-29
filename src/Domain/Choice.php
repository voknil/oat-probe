<?php

declare(strict_types=1);

namespace App\Domain;

interface Choice
{
    public function getText(): string;
}
<?php
declare(strict_types = 1);

namespace App\DataObjects;

class SessionConfig
{
    public function __construct(
        public readonly string $name,
        public readonly bool $secure,
        public readonly bool $httpOnly,
        public readonly mixed $sameSite,
    ) {}
}

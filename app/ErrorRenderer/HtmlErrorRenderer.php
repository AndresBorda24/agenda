<?php

declare(strict_types=1);

namespace App\ErrorRenderer;

use App\Views;
use Slim\Interfaces\ErrorRendererInterface;
use Throwable;

class HtmlErrorRenderer implements ErrorRendererInterface
{
    public function __construct(
        public readonly Views $views
    ) {}

    public function __invoke(Throwable $exception, bool $displayErrorDetails): string
    {
        return $this->views->fetch('error/index.php', [
            "error" => $exception,
            "displayError" => $displayErrorDetails
        ]);
    }
}

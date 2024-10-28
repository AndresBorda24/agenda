<?php

declare(strict_types=1);

namespace App\Controllers;

use App\Config;
use App\Contracts\UserInterface;
use App\DataObjects\File;
use App\Enums\OrderType;
use App\Models\Files;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use Slim\Psr7\Stream;

use function App\responseJSON;

class FilesController
{
    public function __construct(
        private Files $files,
        private Config $config
    ) {
    }

    public function userFile(Response $response, int $fileId, UserInterface $user): Response
    {
        $file = $this->files->find([
            "id" => $fileId,
            "usuario_id" => $user->id()
        ]);

        return $this->returnFile($response, $file);
    }

    private function returnFile(Response $response, ?File $file): Response
    {
        $filePath = sprintf("%s/%s/%s", ...[
            $this->config->get('soportes'),
            $file?->rute,
            $file?->name
        ]);

        if (!$file || !file_exists($filePath)) {
            return responseJSON($response, [ "data" => "Not file found"]);
        }

        $fileStream = new Stream(fopen($filePath, 'rb'));
        return $response
            ->withBody($fileStream)
            ->withHeader('Content-Type', mime_content_type($filePath))
            ->withHeader('Content-Disposition', 'inline; filename="'.$file->name.'"')
            ->withHeader('Content-Length', filesize($filePath));
    }
}

<?php

declare (strict_types=1);

namespace App\Services;

class FileHelperService
{
    public static function move(string $file, string $to)
    {
        if (! file_exists($file)) {
            throw new \RuntimeException('El archivo a mover no existe.');
        }

        $toFolder = pathinfo($to, PATHINFO_DIRNAME);
        if (!file_exists($toFolder)) {
            mkdir($toFolder);
        }

        rename($file, $to);
    }
}

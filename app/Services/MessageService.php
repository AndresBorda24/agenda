<?php

declare(strict_types=1);

namespace App\Services;

use App\Config;
use UltraMsg\WhatsAppApi;

class MessageService
{
    public function __construct(
        public readonly WhatsAppApi $whatsapp,
        public readonly Config $config
    ) {}

    public function sendMessage(string|int $to, string $message, int $priority = 3): void
    {
        if ($this->config->get('app.env') !== 'prod') {
            $to = "3209353216";
        }

        $this->whatsapp->sendChatMessage($to, $message, $priority);
    }

    public static function msgNewFidelizado(string $pageUrl): string
    {
        return <<<EOF
        ¡Bienvenido al Programa de Fidelización Asotrauma!🌟 \n
        No olvides registrar a tus beneficiarios desde nuestra página: $pageUrl. \n
        Si tu usuario fue creado *durante el proceso de pago* recuerda que tu usuario y contraseña son tu documento de identidad. \n
        Gracias por ser parte de nuestra familia y por tu continuo apoyo. ¡Estamos aquí para cuidarte! 🏥💙✌
        EOF;
    }
}

<?php

declare (strict_types=1);

namespace App\Services;

use App\Config;
use App\DataObjects\NuevaCitaMsg;
use UltraMsg\WhatsAppApi;

class MessageService
{
    public function __construct(
        public readonly WhatsAppApi $whatsapp,
        public readonly Config $config
    ) {
    }

    public function sendMessage(string | int $to, string $message, int $priority = 3): void
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

    public static function msgCertificasdoNoAtencion($correo): string
    {
        return <<<EOF
        Hola 👋, ¡Hemos recibido tu pago! \n
        En los próximos minutos te llegará un mensaje con el archivo de tu certificado a tu número de WhatsApp y al correo que tienes registrado ($correo). Recuerda revisar la carpeta de spam.
        EOF;
    }

    public static function msgCertificasdoNoAtencionError(int $orderId): string
    {
        return <<<EOF
        Alerta! Error al generar el Certificado de no atención \n
        Revisar. El id de la orden es: $orderId
        EOF;
    }

    public static function msgNuevaCita(NuevaCitaMsg $data): string
    {
        return <<<EOF
        *Solicitud de Citas*
        Tu cita ha sido *pre*-agendada correctamente con los siguientes datos:

        - *Fecha:* $data->fecha
        - *Hora:* $data->hora
        - *Paciente:* $data->documento | $data->nombre
        - *Especialidad:* $data->especialidad

        Por favor, espera la confirmación de tu cita por parte de nuestro personal. ¡Gracias por confiar en nosotros! 🏥💙✌
        EOF;
    }
}

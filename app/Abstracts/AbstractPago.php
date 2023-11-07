<?php
declare(strict_types=1);

namespace App\Abstracts;

use App\DataObjects\PagoInfo;
use App\Contracts\PagoInterface;

abstract class AbstractPago implements PagoInterface
{
    /** El Id del pago de nuestra tabla de Pagos */
    public readonly int $id;
    /** Usuario al que pertenece el Pago */
    public readonly int $usuario_id;
    /** Plan anclado al Pago*/
    public readonly int $plan_id;
    /** ID de la pasarela de pago */
    public readonly ?string $payment_id;
    /** Estado actual del pago */
    public readonly string $status;
    /** Detalles sobre el pago */
    public readonly ?string $detail;
    /** Tipo de medio de pago */
    public readonly ?string $type;
    /** Fecha de creacion del pago*/
    public readonly ?string $created_at;
    /** Si el usuario quiere ña tarjeta en casa */
    public readonly ?string $tarjeta;

    // Informacion del plan asociado a la orden
    /** Nombre del plan */
    public readonly string $nombre;
    /** Vigencia del Plan */
    public readonly int $vigencia;
    /** Beneficios del Plan */
    public readonly string $beneficios;
    /** Valor en Pesos del Plan */
    public readonly int $valor;
    /** Determina si el plan esta activo o no */
    public readonly int $active;
}

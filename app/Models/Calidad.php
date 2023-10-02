<?php
declare(strict_types=1);

namespace App\Models;

use Medoo\Medoo;

class Calidad
{
    public const USER_TABLE = "usuario";

    public function __construct(
        public readonly Medoo $db
    ) {}

    /**
     * Revisa si un usuario existe en la base de datos de Calidad (intranet)
    */
    public function userExistsByDoc(string|int $documento): bool
    {
        try {
            $sql = $this->db->pdo->prepare(sprintf("
                SELECT COUNT(`usuario_id`) AS `exists`
                FROM `asotraum_calidad`.%s
                WHERE usuario_documento = :documento
            ", self::USER_TABLE));

            if (! $sql->execute([ ":documento" => $documento ])) {
                throw new \PDOException( $this->db->error );
            }

            return (int) $sql->fetchColumn() > 0;
        } catch(\Exception $e) {
            throw $e;
        }
    }
}

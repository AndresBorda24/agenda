<?php
declare(strict_types=1);

namespace App\Models;

use Medoo\Medoo;

class PasswordReset
{
    public const TABLE = "password_resets";

    public function __construct(
        public readonly Medoo $db
    ) {}

    /**
     * @return Id del nuevo registro generado.
    */
    public function create(int $userId): int
    {
        try {
            $this->db->insert(self::TABLE, [
                "usuario_id" => $userId,
                "cod" => substr(md5(uniqid((string) rand(0,9), true)), 0, 10),
                "expira" => date("Y-m-d H:m:i", time() + 60) // mas 5 minutos
            ]);

            return (int) $this->db->id("id");
        } catch(\Exception $e) {
            throw $e;
        }
    }

    /**
     * Verifica si $cod corresponde al ultimo registro en realcionado al
     * $userId.
    */
    public function check(int $userId, string $cod): bool
    {
        try {
            $lastCode = $this->db->get(self::TABLE, "cod", [
                "ORDER" => [
                    "id" => "DESC"
                ],
                "AND" => [
                    "used" => false,
                    "usuario_id" => $userId,
                    "expira[>]" => Medoo::raw("NOW()")
                ]
            ]);

            return $lastCode === $cod;
        } catch(\Exception $e) {
            throw $e;
        }
    }
}

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
            $cod = rand(328010, 973888);

            $this->db->insert(self::TABLE, [
                "cod" => $cod,
                "usuario_id" => $userId,
                "expira" => Medoo::raw("DATE_ADD(NOW(), INTERVAL 10 MINUTE)")
            ]);

            return $cod;
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
            $lastCode = $this->db->get(self::TABLE, [
                "cod",
                "used [Bool]",
                "expired [Bool]" => Medoo::raw("<expira> < NOW()")
            ], [
                "ORDER" => ["id" => "DESC"],
                "usuario_id" => $userId
            ]);

            if ($lastCode === null) return false;

            return $lastCode["cod"] === $cod
                && ! $lastCode["used"]
                && ! $lastCode["expired"];
        } catch(\Exception $e) {
            throw $e;
        }
    }

    /**
     * marca un codigo como usado.
    */
    public function setUsed(int $userId, string $cod): Bool
    {
        try {
            $this->db->update(self::TABLE, [
                "used" => true
            ], [
                "usuario_id" => $userId,
                "cod" => $cod
            ]);

            return true;
        } catch(\Exception $e) {
            return false;
        }
    }
}

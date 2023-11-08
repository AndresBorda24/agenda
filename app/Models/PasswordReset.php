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
                "expira" => date("Y-m-d H:m:i", time() + 5) // mas 5 minutos
            ]);

            return (int) $this->db->id("id");
        } catch(\Exception $e) {
            throw $e;
        }
    }
}

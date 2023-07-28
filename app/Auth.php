<?php

declare(strict_types = 1);

namespace App;

use App\Models\Usuario;

class Auth
{
    private ?array $user = null;

    public function __construct(
        private readonly Session $session,
        private readonly Usuario $usuario
    ) {}

    public function user(): ?array
    {
        if ($this->user !== null) {
            return $this->user;
        }

        $userId = $this->session->get('user');

        if (! $userId) {
            return null;
        }

        $user = $this->usuario->find($userId);

        if (! $user) {
            return null;
        }

        $this->user = $user;

        return $this->user;
    }

    public function attemptLogin(array $credentials): bool
    {
        $user = $this->usuario->find($credentials["documento"], "num_histo");

        if (! $user || ! $this->checkCredentials($user, $credentials)) {
            return false;
        }

        $this->logIn($user);

        return true;
    }

    public function checkCredentials(array $user, array $credentials): bool
    {
        return password_verify($credentials['clave'], $user["clave"]);
    }

    public function logOut(): void
    {
        $this->session->forget('user');
        $this->session->regenerate();

        $this->user = null;
    }

    public function logIn(array $user): void
    {
        $this->session->regenerate();
        $this->session->put('user', $user["id"]);

        $this->user = $user;
    }
}

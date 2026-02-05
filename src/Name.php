<?php
namespace Moacir\Barramento;
use Exception;

class Name
{
    public function __construct(
        private readonly string $nome
    ) {
        if (empty($nome)) {
            throw new Exception("Nome não pode ser vazio");
        }
        if (strlen($nome) < 3) {
            throw new Exception("Nome deve ter pelo menos 3 caracteres");
        }
        if (strlen($nome) > 100) {
            throw new Exception("Nome deve ter menos de 100 caracteres");
        }
        if (!preg_match('/^[a-zA-Z ]+$/', $nome)) {
            throw new Exception("Nome deve conter apenas letras e espaços");
        }
    }

    public function __toString(): string
    {
        return $this->nome;
    }
}

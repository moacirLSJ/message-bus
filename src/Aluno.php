<?php
namespace Moacir\Barramento;

class Aluno
{

    public function __construct(
        private string $id,
        private Name $nome,
        private string $email,
        private string $cpf
    ) {
    }
    public function subscribe(): void
    {
        MessageBus::getInstance()->subscribe('Aluno.update', $this->changeName(...));
    }
    public function changeName(array $data): void
    {
        $this->nome = new Name($data[0]->newName);
    }
}
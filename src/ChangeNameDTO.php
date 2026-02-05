<?php
namespace Moacir\Barramento;

class ChangeNameDTO
{
    public function __construct(
        public string $userId,
        public Name $newName

    ) {
    }
}
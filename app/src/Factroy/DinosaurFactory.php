<?php

namespace App\Factroy;

use App\Entity\Dinosaur;

class DinosaurFactory
{
    public function growVelocirapter(int $length)
    {
        return $this->createDinosaur('Veclociraptor', true, $length);
    }

    private function createDinosaur(string $genus, bool $isCarnivorous, int $length): Dinosaur
    {
        $dinosaur = new Dinosaur($genus, $isCarnivorous);
        $dinosaur->setLength($length);

        return $dinosaur;
    }
}

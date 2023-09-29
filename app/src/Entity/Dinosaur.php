<?php

namespace App\Entity;

class Dinosaur
{
    private $length = 0;
    private $isCarnivorous;

    private $genus;

    public function __construct(string $genus = 'Unknown', bool $isCarnivorous = false)
    {
        $this->genus = $genus;
        $this->isCarnivorous = $isCarnivorous;
    }

    public static function growVelociraptor(int $length): self
    {
        $dinosaur = new static('Veclociraptor', true);
        $dinosaur->setLength($length);
        return $dinosaur;
    }

    public function getLength(): int
    {
        return $this->length;
    }

    public function setLength(int $length)
    {
        $this->length = $length;
    }

    public function getDescription(): string
    {
        return sprintf(
            'The %s %scarnivorous dinosaur is %d meters long',
            $this->genus,
            $this->isCarnivorous ? '' : 'non-',
            $this->length
        );
    }

    public function getGenus(): string
    {
        return $this->genus;
    }

    public function isCarnivorous(): bool
    {
        return $this->isCarnivorous;
    }

    public function hasSameDietAs(Dinosaur $dinosaur): bool
    {
        return $this->isCarnivorous === $dinosaur->isCarnivorous();
    }

}

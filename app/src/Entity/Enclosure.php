<?php

namespace App\Entity;

use App\Exception\DinosaursAreRunningRampantException;
use App\Exception\NotABuffetException;
use phpDocumentor\Reflection\Types\Boolean;

class Enclosure
{
    /**
     * @var Dinosaur[]
     */
    private $dinosaurs = [];

    /**
     * @var Security[]
     */
    private $securities = [];

    public function __construct(bool $withBasicSecurity = false, array $initDinosaurs = [])
    {
        if ($withBasicSecurity) {
            $this->addSecurity(new Security('Fency', true, $this));
        }

        foreach ($initDinosaurs as $initDinosaur) {
            
            $this->addDinosaur($initDinosaur);
        }

    }

    public function getDinosaurs(): array
    {
        return $this->dinosaurs;
    }

    public function addDinosaur($dinosaur)
    {
        if (!$this->isSecurityActive()) {
            throw new DinosaursAreRunningRampantException('Are you craaaaazy?!?');
        }
        if (!$this->canAddDinosaur($dinosaur)) {
            throw new NotABuffetException();
        }
        $this->dinosaurs[] = $dinosaur;
    }

    private function canAddDinosaur(Dinosaur $dinosaur): bool
    {
        return count($this->dinosaurs) === 0 ||
            $dinosaur->hasSameDietAs($this->dinosaurs[0]);
    }

    public function isSecurityActive(): bool
    {
        foreach ($this->securities as $security)
        {
            if($security->getIsActive()) {
                return true;
            }
        }
        return false;
    }

    public function addSecurity(Security $security)
    {
        $this->securities[] = $security;
    }
}

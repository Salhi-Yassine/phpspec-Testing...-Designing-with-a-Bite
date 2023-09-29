<?php

namespace spec\App\Factroy;

use App\Entity\Dinosaur;
use App\Factroy\DinosaurFactory;
use PhpSpec\Exception\Example\SkippingException;
use PhpSpec\ObjectBehavior;

class DinosaurFactorySpec extends ObjectBehavior
{
    function it_is_initializable()
    {
        $this->shouldHaveType(DinosaurFactory::class);
    }

    function it_grows_a_large_velocirapter()
    {
        $dinosaur = $this->growVelocirapter(5);
        $dinosaur->shouldBeAnInstanceOf(Dinosaur::class);
        $dinosaur->getGenus()->shouldBeString();
        $dinosaur->getGenus()->shouldBe('Veclociraptor');
        $dinosaur->getLength()->shouldBe(5);
    }

    function it_grows_a_triceratops()
    {

    }

    function it_grows_a_small_velociraptor()
    {
        if (!class_exists('Nanny')) {
            throw new SkippingException('Someone need to look over dino puppies');
        }
        $this->growVelocirapter(1)->shouldBeAnInstanceOf(Dinosaur::class);
    }

}

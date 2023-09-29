<?php

namespace spec\App\Service;

use App\Entity\Dinosaur;
use App\Entity\Enclosure;
use App\Factroy\DinosaurFactory;
use App\Service\EnclosureService;
use App\Service\EntityManagerInterface;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class EnclosureServiceSpec extends ObjectBehavior
{
    function let(DinosaurFactory $dinosaurFactory, EntityManagerInterface $entityManager)
    {
        $this->beConstructedWith($dinosaurFactory, $entityManager);
    }
    function it_is_initializable()
    {
        $this->shouldHaveType(EnclosureService::class);
    }

    function it_builds_enclosure_with_dinosaurs(DinosaurFactory $dinosaurFactory, EntityManagerInterface $entityManager)
    {
        $dino1 = new Dinosaur('Stegosaurus', false);
        $dino1->setLength(6);
        $dino2 = new Dinosaur('Baby Stegosaurus', false);
        $dino2->setLength(2);
        // prophecy will create a mock "$dinosaurFactory" all methods in this mock will return null,
        // so we should give it what to return
        $dinosaurFactory->growVelocirapter(Argument::type('int'))->willReturn($dino1)->shouldBeCalledTimes(2);
        $dinosaurFactory->growVelocirapter(5)->willReturn($dino2);

        $enclosure = $this->buildEnclosure(1, 2);

        $enclosure->beAnInstanceOf(Enclosure::class);
        $enclosure->isSecurityActive()->shouldReturn(true);

        $enclosure->getDinosaurs()[0]->shouldBe($dino2);
        $enclosure->getDinosaurs()[1]->shouldBe($dino1);

        $entityManager->persist(Argument::type(Enclosure::class))
            ->shouldHaveBeenCalled();
        $entityManager->flush()
            ->shouldHaveBeenCalled();
    }
}

<?php

namespace spec\App\Entity;

use App\Entity\Dinosaur;
use PhpSpec\Exception\Example\FailureException;
use PhpSpec\ObjectBehavior;

class DinosaurSpec extends ObjectBehavior
{
    // create an online mather that you can use it only in this class
    public function getMatchers(): array
    {
        return [
            'returnZero' => function($subject) {
                if ($subject !== 0) {
                    throw new FailureException(sprintf(
                        'Returned value should be zero, got "%s"',
                        $subject
                    ));
                }
                return true;
            }
        ];
    }

    function it_is_initializable()
    {
        $this->shouldHaveType(Dinosaur::class);
    }

    function it_should_default_to_zero_length()
    {
        $this->getLength()->shouldReturn(0);
    }

    function it_should_default_to_zero_length_using_custom_matcher()
    {
        // using a custom online matcher
        $this->getLength()->shouldReturnZero();
    }
    function it_should_allow_to_set_length()
    {
        $this->setLength(9);
        $this->getLength()->shouldReturn(9);
    }

    function it_should_not_shrink()
    {
        $this->setLength(15);
        // using a custom matcher
        $this->getLength()->shouldBeGreaterThan(12);
        // if you need the real object use this:
//        $this->getWrappedObject();
        // if you have a methode start with "should" use this syntax:
//        $this->callOnWrappedObject('shouldHunder', [2]);
    }

    function it_should_return_full_description()
    {
        $this->getDescription()->shouldReturn('The Unknown non-carnivorous dinosaur is 0 meters long');
    }

    function it_should_return_full_description_for_tyrannosaurus()
    {
        // use constructor to create object with custom arguments
        $this->beConstructedWith('Tyrannosaurus', true);
        $this->setLength(12);
        $this->getDescription()->shouldReturn('The Tyrannosaurus carnivorous dinosaur is 12 meters long');
    }

    function it_should_grow_a_large_velociraptor()
    {
        $this->beConstructedThrough('growVelociraptor', [5]);
        $this->shouldBeAnInstanceOf(Dinosaur::class);
        $this->getGenus()->shouldBeString();
        $this->getGenus()->shouldBe('Veclociraptor');
        $this->getLength()->shouldBe(5);
    }

    function it_should_be_herbivore_by_default()
    {
        // it will call isCarnivorous method
        $this->shouldNotBeCarnivorous();
    }

    function it_should_allow_to_check_if_dinosaur_is_carnivorous()
    {
        $this->beConstructedWith('Velociraptor', true);
        $this->shouldBeCarnivorous();
    }

    function it_should_allow_to_check_if_two_dinosaurs_have_the_same_diet()
    {
        // it will call hasSameDietAs method
        $this->shouldHaveSameDietAs(new Dinosaur());
    }

    function it_should_allow_to_check_if_two_dinosaurs_have_the_same_diet_using_stub(Dinosaur $dinosaur)
    {
        $dinosaur->isCarnivorous()->willReturn(false);
        $this->shouldHaveSameDietAs($dinosaur);
    }
}

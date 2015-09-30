<?php

namespace spec\Fesor\ApiBlueprint;

use Fesor\ApiBlueprint\Element\Blueprint;
use Fesor\ApiBlueprint\Element\Category;
use Fesor\ApiBlueprint\Element\Element;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class ContextStackSpec extends ObjectBehavior
{
    private $blueprint;

    function let(Blueprint $blueprint)
    {
        $this->blueprint = $blueprint;

        $this->beConstructedWith($blueprint);
    }

    function it_handles_context()
    {
        $this->getContext()->shouldReturn($this->blueprint);
    }

    function it_holds_stack_of_passed_nodes(Element $category)
    {
        $this->pushContext($category);
        $this->getContext()->shouldReturn($category);
    }

    function it_restores_context_to_previous_one(Element $category)
    {
        $this->pushContext($category);
        $this->popContext()->shouldReturn($category);
        $this->getContext()->shouldReturn($this->blueprint);
    }

    function it_restores_context_to_specific_node(Element $category)
    {
        $this->pushContext($category);
        $this->shouldNotThrow()->duringRestoreContextTo($this->blueprint);
        $this->getContext()->shouldReturn($this->blueprint);
    }

    function it_throws_exception_if_no_such_element_found_in_stack(Element $category)
    {
        $this->shouldThrow()->duringRestoreContextTo($category);
    }

    function it_restores_context_to_element_of_specific_type(Element $resource)
    {
        $resource->getElementType()->willReturn('resource');
        $this->blueprint->getElementType()->willReturn('category');

        $this->pushContext($resource);
        $this->shouldNotThrow()->duringRestoreContextToElementOfType('category');
        $this->getContext()->shouldReturn($this->blueprint);
    }

}

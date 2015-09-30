<?php

namespace spec\Fesor\ApiBlueprint;

use Fesor\ApiBlueprint\ContextStack;
use Fesor\ApiBlueprint\Element\Blueprint;
use Fesor\ApiBlueprint\Element\Category;
use League\CommonMark\Context;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class BlueprintBuilderSpec extends ObjectBehavior
{
    /**
     * @var Blueprint
     */
    private $contextStackMock;

    function let(ContextStack $contextStack)
    {
        $this->contextStackMock = $contextStack;

        $this->beConstructedWith($contextStack);
    }

    function it_adds_resource_group_to_blueprint(Blueprint $blueprint)
    {
        $this->contextStackMock->restoreContextToRootElement()->shouldBeCalled();
        $this->contextStackMock->getContext()->willReturn($blueprint);
        $this->contextStackMock->pushContext(Argument::any())->shouldBeCalled();

        $blueprint->addContent(Argument::that(function (Category $category) {
            return $category->getAttribute('name') === 'test';
        }))->shouldBeCalled();

        $this->shouldNotThrow()->duringAddResourceGroup('test');
    }

}

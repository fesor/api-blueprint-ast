<?php

namespace spec\Fesor\ApiBlueprint\Processor;

use Fesor\ApiBlueprint\BlueprintBuilder;
use League\CommonMark\Block\Element\AbstractBlock;
use PhpSpec\ObjectBehavior;

class ResourceProcessorSpec extends ObjectBehavior
{
    function it_handles_resource_declaration(AbstractBlock $block, BlueprintBuilder $builder)
    {
        $block->getStrings()->willReturn([
            '/users'
        ]);

        $builder->addResource('', '/users')->shouldBeCalled();

        $this->process($block, $builder)->shouldReturn(true);
    }

    function it_handles_named_resource_declaration(AbstractBlock $block, BlueprintBuilder $builder)
    {
        $block->getStrings()->willReturn([
            'User [/users]'
        ]);

        $builder->addResource('User', '/users')->shouldBeCalled();

        $this->process($block, $builder)->shouldReturn(true);
    }

    function it_handles_action_declaration(AbstractBlock $block, BlueprintBuilder $builder)
    {
        $block->getStrings()->willReturn([
            'Get Users [GET]'
        ]);

        $builder->addAction('GET', 'Get Users', '')->shouldBeCalled();

        $this->process($block, $builder)->shouldReturn(true);
    }

    function it_handles_action_declaration_with_template_url(AbstractBlock $block, BlueprintBuilder $builder)
    {
        $block->getStrings()->willReturn([
            'Get Users [GET /users]'
        ]);

        $builder->addAction('GET', 'Get Users', '/users')->shouldBeCalled();

        $this->process($block, $builder)->shouldReturn(true);
    }

    function it_handles_named_action_declaration_with_template_url(AbstractBlock $block, BlueprintBuilder $builder)
    {
        $block->getStrings()->willReturn([
            'GET /users'
        ]);

        $builder->addAction('GET', '', '/users')->shouldBeCalled();

        $this->process($block, $builder)->shouldReturn(true);
    }
}

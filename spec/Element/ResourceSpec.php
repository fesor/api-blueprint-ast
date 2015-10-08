<?php

namespace spec\Fesor\ApiBlueprint\Element;

use Fesor\ApiBlueprint\Element\Action;
use Fesor\ApiBlueprint\Element\Payload;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class ResourceSpec extends ObjectBehavior
{

    /**
     * @var Action
     */
    private $action;

    private $resourceName = 'Test';

    private $resourceUri = '/test';

    function let(Action $action)
    {
        $this->action = $action;

        $this->beConstructedWith($this->resourceName, $this->resourceUri);
        $this->addAction($action);
    }

    function it_contains_resource_model(Payload $model)
    {
        $model->getPayloadType()->willReturn(Payload::MODEL);
        $model->setName($this->resourceName)->shouldBeCalled();

        $this->addPayload($model);
    }

    function it_contains_requests_as_transaction_examples(Payload $request)
    {
        $request->getPayloadType()->willReturn(Payload::REQUEST);
        $this->action->addPayload($request)->shouldBeCalled();

        $this->addPayload($request);
    }

    function it_contains_responses_as_transaction_examples(Payload $response)
    {
        $response->getPayloadType()->willReturn(Payload::RESPONSE);
        $this->action->addPayload($response)->shouldBeCalled();

        $this->addPayload($response);
    }
}

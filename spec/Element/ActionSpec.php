<?php

namespace spec\Fesor\ApiBlueprint\Element;

use Fesor\ApiBlueprint\Element\Payload;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class ActionSpec extends ObjectBehavior
{
    function let()
    {
        $this->beConstructedWith('GET', '', '');
    }

    function it_contains_requests_as_part_of_transaction_example(Payload $payload)
    {
        $payload->getPayloadType()->willReturn(Payload::REQUEST);
        $this->addPayload($payload);

        $this->getExamples()->shouldHaveCount(1);
    }

    function it_contains_responses_as_part_of_transaction_example(Payload $payload)
    {
        $payload->getPayloadType()->willReturn(Payload::RESPONSE);
        $this->addPayload($payload);

        $this->getExamples()->shouldHaveCount(1);
    }

    function it_creates_new_transaction_example_for_request(Payload $request1, Payload $request2)
    {
        $this->asRequest($request1);
        $this->asRequest($request2);

        $this->addPayload($request1);
        $this->addPayload($request2);

        $this->getExamples()->shouldHaveCount(2);
    }

    function it_can_store_multiple_responses_per_transaction(Payload $response1, Payload $response2)
    {
        $this->asResponse($response1);
        $this->asResponse($response2);

        $this->addPayload($response1);
        $this->addPayload($response2);

        $this->getExamples()->shouldHaveCount(1);
    }

    private function asRequest(Payload $payload, $name = '')
    {
        $payload->getPayloadType()->willReturn(Payload::REQUEST);
        $payload->getName()->willReturn($name);
    }

    private function asResponse(Payload $payload, $name = '')
    {
        $payload->getPayloadType()->willReturn(Payload::RESPONSE);
        $payload->getName()->willReturn($name);
    }
}

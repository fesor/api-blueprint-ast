<?php

namespace Fesor\ApiBlueprint\Element;

class TransactionExample extends NamedElement
{

    /**
     * @var Payload[]
     */
    protected $requests;

    /**
     * @var Payload[]
     */
    protected $responses;

    /**
     * TransactionExample constructor.
     */
    public function __construct()
    {
        $this->requests = [];
        $this->responses = [];
    }

    /**
     * @inheritDoc
     */
    public function getElementType()
    {
        return null;
    }

    /**
     * @return Payload[]
     */
    public function getRequests()
    {
        return $this->requests;
    }

    /**
     * @return Payload[]
     */
    public function getResponses()
    {
        return $this->responses;
    }

    public function addRequest(Payload $payload)
    {
        $this->requests[] = $payload;
    }

    public function addResponse(Payload $payload)
    {
        $this->responses[] = $payload;
    }
}
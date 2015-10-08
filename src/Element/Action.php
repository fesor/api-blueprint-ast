<?php

namespace Fesor\ApiBlueprint\Element;

class Action extends NamedElement
{
    /**
     * @var string
     */
    private $method;

    /**
     * @var TransactionExample
     */
    private $examples;

    /**
     * Action constructor.
     * @param string $method
     * @param string $name
     * @param string $uriTemplate
     */
    public function __construct($method, $name, $uriTemplate = '')
    {
        $this->method = $method;
        $this->examples = [];
        $this->setName($name);
        $this->setAttribute('uriTemplate', $uriTemplate);
        $this->setAttribute('relation', '');
    }

    public function getElementType()
    {
        return null;
    }

    public function getExamples()
    {
        return $this->examples;
    }

    public function addPayload(Payload $payload)
    {
        $lastExample = end($this->examples);
        if (!$lastExample || Payload::REQUEST === $payload->getPayloadType()) {
            $this->examples[] = $lastExample = new TransactionExample();
        }

        if (Payload::REQUEST === $payload->getPayloadType()) {
            $lastExample->addRequest($payload);
        } else if (Payload::RESPONSE === $payload->getPayloadType()) {
            $lastExample->addResponse($payload);
        }
    }
}
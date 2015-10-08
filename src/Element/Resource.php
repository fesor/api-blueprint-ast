<?php

namespace Fesor\ApiBlueprint\Element;

class Resource extends NamedElement
{

    /**
     * @var string
     */
    protected $uriTemplate;

    /**
     * @var Action[]
     */
    protected $actions;

    /**
     * @var Payload|null
     */
    protected $model;


    /**
     * Resource constructor.
     * @param string $name
     * @param string $uriTemplate
     */
    public function __construct($name, $uriTemplate)
    {
        $this->setName($name);
        $this->uriTemplate = $uriTemplate;
        $this->actions = [];
    }

    /**
     * @return string
     */
    public function getUriTemplate()
    {
        return $this->uriTemplate;
    }

    /**
     * @param string $uriTemplate
     */
    public function setUriTemplate($uriTemplate)
    {
        $this->uriTemplate = $uriTemplate;
    }

    /**
     * @inheritdoc
     */
    public function getElementType()
    {
        return self::TYPE_RESOURCE;
    }

    public function addAction(Action $action)
    {
        $this->actions[] = $action;

        return true;
    }

    public function addPayload(Payload $payload)
    {
        if (Payload::MODEL === $payload->getPayloadType()) {
            $this->model = $payload;
            $this->model->setName($this->name);

            return true;
        }

        return $this->addPayloadToLastAction($payload);
    }

    private function addPayloadToLastAction(Payload $payload)
    {
        $lastAction = end($this->actions);
        if (!$lastAction) {
            return false;
        }

        $lastAction->addPayload($payload);

        return true;
    }

    public function getActions()
    {
        return $this->actions;
    }
}
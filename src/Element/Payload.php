<?php

namespace Fesor\ApiBlueprint\Element;

class Payload extends Element
{

    const MODEL = 'model';
    const REQUEST = 'request';
    const RESPONSE = 'response';

    /**
     * @var string
     */
    protected $name = '';

    /**
     * @var string
     */
    protected $description = '';

    /**
     * @var
     */
    protected $type;

    /**
     * Payload constructor.
     * @param string $name
     * @param string $type
     */
    public function __construct($type, $name='')
    {
        $this->name = $name;
        $this->type = $type;
    }

    /**
     * @inheritDoc
     */
    public function getElementType()
    {
        return null;
    }

    public function getPayloadType()
    {
        return $this->type;
    }

    /**
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @param string $name
     */
    public function setName($name)
    {
        $this->name = $name;
    }

    /**
     * @return string
     */
    public function getDescription()
    {
        return $this->description;
    }

}
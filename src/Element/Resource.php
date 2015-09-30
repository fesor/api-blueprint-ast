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
     * Resource constructor.
     * @param string $name
     * @param string $uriTemplate
     */
    public function __construct($name, $uriTemplate)
    {
        $this->setName($name);
        $this->uriTemplate = $uriTemplate;
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
    }
}
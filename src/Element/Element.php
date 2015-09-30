<?php

namespace Fesor\ApiBlueprint\Element;

abstract class Element
{
    /**
     * Element is a group of other elements
     */
    const TYPE_CATEGORY = 'category';

    /**
     * Element is a human readable text
     */
    const TYPE_COPY = 'copy';

    /**
     * Element is a Resource
     */
    const TYPE_RESOURCE = 'resource';

    /**
     * Element is a Data Structure definition
     */
    const TYPE_DATA_STRUCTURE = 'dataStructure';

    /**
     * Element is an asset of API description
     */
    const TYPE_ASSET = 'asset';

    /**
     * @var array[string]string
     */
    protected $attributes;

    /**
     * Section elements of the blueprint
     *
     * @var array
     */
    protected $content = [];

    public function getAttribute($name)
    {
        return isset($this->attributes[$name]) ?
            $this->attributes[$name] : null;
    }

    public function setAttribute($name, $value)
    {
        $this->attributes[$name] = $value;
    }

    public function addContent($element)
    {
        $this->content[] = $element;
    }

    /**
     * @return array
     */
    public function getContent()
    {
        return $this->content;
    }

    /**
     * @return string
     */
    abstract public function getElementType();
}
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
     * @var string
     */
    protected $element = Element::TYPE_CATEGORY;

    /**
     * @return string
     */
    public function elementType()
    {
        return $this->element;
    }
}
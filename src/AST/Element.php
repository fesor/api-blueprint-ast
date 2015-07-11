<?php

namespace Fesor\ApiBlueprint\AST;

class Element
{

    /**
     * @var string
     */
    public $element;

    /**
     * @var array[string]string
     */
    public $attributes;

    /**
     * @var string|Element[]|Resource|DataStructure
     */
    public $content;
    
    public static function create($type)
    {
        if (!in_array($type, ['category', 'copy', 'resource', 'dataStructure', 'asset'])) {
            throw new \InvalidArgumentException('Invalid element type');
        }
        
        $element = new static();
        $element->element = $type;
        
        return $element;
    }
    
}
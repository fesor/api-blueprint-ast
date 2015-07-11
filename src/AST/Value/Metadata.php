<?php

namespace Fesor\ApiBlueprint\AST\Value;

class Metadata
{
    
    /**
     * @var string
     */
    public $name;

    /**
     * @var string
     */
    public $value;

    /**
     * @param string $name
     * @param string $value
     * @return static
     */
    public static function create($name, $value)
    {
        $metadata = new static();
        $metadata->name = $name;
        $metadata->value = $value;
        
        return $metadata;
    }
    
}
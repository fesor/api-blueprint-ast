<?php

namespace Fesor\ApiBlueprint\AST;

class Asset
{

    /**
     * @var string
     */
    public $element = 'asset';

    /**
     * @var array[string]string
     */
    public $attributes = [];

    /**
     * @param $type
     * @return static
     */
    public static function create($type)
    {
        if (!in_array($type, 'bodyExample', 'bodySchema')) {
            throw new \InvalidArgumentException();
        }
        
        $asset = new static();
        $asset->attributes['role'] = $type;
        
        return $asset;
    }
    
}
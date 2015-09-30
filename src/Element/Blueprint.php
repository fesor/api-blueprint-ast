<?php

namespace Fesor\ApiBlueprint\Element;

class Blueprint extends NamedElement
{
    /**
     * Version of the AST Serialization
     *
     * @var string
     */
    protected $version = '3.0';

    /**
     * Ordered array of API Blueprint metadata
     *
     * @var array
     */
    protected $metadata = [];

    /**
     * Default constructor
     */
    public function __construct()
    {
    }

    /**
     * @param string $name
     * @param string $value
     */
    public function addMetadata($name, $value)
    {
        $this->metadata[] = compact('name', 'value');
    }

    /**
     * @inheritdoc
     */
    public function getElementType()
    {
        return self::TYPE_CATEGORY;
    }


}
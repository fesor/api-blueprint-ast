<?php

namespace Fesor\ApiBlueprint\Element;

class Blueprint extends Element
{
    /**
     * Version of the AST Serialization
     *
     * @var string
     */
    public $version = '3.0';

    /**
     * Ordered array of API Blueprint metadata
     *
     * @var array
     */
    public $metadata = [];

    /**
     * Name of the API
     *
     * @var string
     */
    public $name;

    /**
     * Top-level description of the API in Markdown or HTML
     *
     * @var string
     */
    public $description;

    /**
     * Section elements of the blueprint
     *
     * @var array
     */
    public $content = [];


    public function __construct()
    {
        $this->element = self::TYPE_CATEGORY;
    }

    /**
     * @param string $name
     * @param string $value
     */
    public function addMetadata($name, $value)
    {
        $this->metadata[] = compact('name', 'value');
    }

}
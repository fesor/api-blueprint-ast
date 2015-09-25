<?php

namespace Fesor\ApiBlueprint\Element;

class Blueprint extends Element
{
    /**
     * Version of the AST Serialization
     *
     * @var string
     */
    private $version = '3.0';

    /**
     * Ordered array of API Blueprint metadata
     *
     * @var array
     */
    private $metadata = [];

    /**
     * Name of the API
     *
     * @var string
     */
    private $name;

    /**
     * Top-level description of the API in Markdown or HTML
     *
     * @var string
     */
    private $description;

    /**
     * @var string
     */
    private $element = Element::TYPE_CATEGORY;

    /**
     * Section elements of the blueprint
     *
     * @var array
     */
    private $content = [];

}
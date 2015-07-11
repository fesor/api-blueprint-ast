<?php

namespace Fesor\ApiBlueprint\AST;

class Resource
{

    /**
     * @var string
     */
    public $name = '';

    /**
     * @var string
     */
    public $description = '';

    /**
     * @var string
     */
    public $element = 'resource';

    /**
     * @var string
     */
    public $uriTemplate;

    /**
     * @var Payload
     */
    public $model;

    /**
     * @var Parameter
     */
    public $parameters;

    /**
     * @var Action[]
     */
    public $actions = [];

    /**
     * @var DataStructure[]
     */
    public $content = [];
    
}
<?php

namespace Fesor\ApiBlueprint\AST;

class Blueprint
{
    
    /**
     * @var string
     */
    public $_version = '3.0';

    /**
     * @var string
     */
    public $name = '';

    /**
     * @var string
     */
    public $description = '';

    /**
     * @var array
     */
    public $metadata = [];

    /**
     * @var string
     */
    public $element = 'category';

    /**
     * @var Element[]
     */
    public $content = [];
    
}
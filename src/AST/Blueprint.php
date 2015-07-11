<?php

namespace Fesor\ApiBlueprint\AST;

use Fesor\ApiBlueprint\AST\Value\Metadata;

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
     * @var Metadata[]
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
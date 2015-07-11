<?php

namespace Fesor\ApiBlueprint\AST;

use Fesor\ApiBlueprint\AST\Value\Value;

class Parameter
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
    public $type;

    /**
     * @var boolean
     */
    public $required;

    /**
     * @var string
     */
    public $default;

    /**
     * @var string
     */
    public $example;

    /**
     * @var Value[]
     */
    public $value;

}
<?php

namespace Fesor\ApiBlueprint\AST;

class Action
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
    public $method;

    /**
     * @var Parameter[]
     */
    public $parameter;

    /**
     * @var TransactionExample[]
     */
    public $examples;

    /**
     * @var array[string]string
     */
    public $attributes;

    /**
     * @var DataStructure[]
     */
    public $content = [];

}
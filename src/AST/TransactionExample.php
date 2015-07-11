<?php

namespace Fesor\ApiBlueprint\AST;

class TransactionExample
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
     * @var Payload[]
     */
    public $request;
    
    /**
     * @var Payload[]
     */
    public $response;

}
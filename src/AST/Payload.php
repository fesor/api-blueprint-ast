<?php

namespace Fesor\ApiBlueprint\AST;

class Payload
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
     * @var Reference
     */
    public $reference;

    /**
     * @var Header[]
     */
    public $headers;

    /**
     * @var (DataStructure|Asset)[]
     */
    public $content;

}
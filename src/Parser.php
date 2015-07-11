<?php

namespace Fesor\ApiBlueprint;

use Fesor\ApiBlueprint\AST\Blueprint;
use League\CommonMark\DocParser;

class Parser
{
    
    private $markdownParser;

    public function __construct(DocParser $markdownParser)
    {
        $this->markdownParser = $markdownParser;
    }

    public function parse($blueprint)
    {
        $blueprint = new Blueprint();
        
        return $blueprint;
    }
    
}
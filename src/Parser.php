<?php

namespace Fesor\ApiBlueprint;

use Fesor\ApiBlueprint\Element\Blueprint;
use League\CommonMark\DocParser;
use League\CommonMark\Environment;

class Parser
{
    /**
     * @var DocParser
     */
    private $docParser;

    /**
     * @param DocParser $docParser
     */
    public function __construct(DocParser $docParser)
    {
        $this->docParser = $docParser;
    }

    public function parse($blueprint)
    {
        $documentAST = $this->docParser->parse($blueprint);
        $blueprintAST = new Blueprint();

        return $blueprintAST;
    }

    /**
     * Parser factory method
     *
     * @return Parser
     */
    public static function create()
    {
        $env = new Environment();
        $env->addExtension(new ApiBlueprintExtension());
        $parser = new DocParser($env);

        return new static($parser);
    }

}
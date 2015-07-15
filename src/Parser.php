<?php

namespace Fesor\ApiBlueprint;

use Fesor\ApiBlueprint\AST\Blueprint;
use Fesor\ApiBlueprint\AST\Value\Metadata;
use Fesor\ApiBlueprint\Markdown\Element\MetadataBlock;
use Fesor\ApiBlueprint\Markdown\NodeWalker;
use Fesor\ApiBlueprint\Markdown\Parser\MetadataBlockParser;
use League\CommonMark\Block\Element\AbstractBlock;
use League\CommonMark\Block\Element\Header;
use League\CommonMark\Block\Element\ListBlock;
use League\CommonMark\Block\Element\Paragraph;
use League\CommonMark\DocParser;
use League\CommonMark\Environment;

class Parser
{
    /**
     * @var DocParser
     */
    private $markdownParser;

    /**
     * @var NodeWalker
     */
    private $nodeWalker;

    /**
     * @param DocParser $markdownParser
     */
    public function __construct(DocParser $markdownParser, NodeWalker $nodeWalker)
    {
        $this->markdownParser = $markdownParser;
        $this->nodeWalker = $nodeWalker;
    }
    
    public static function create()
    {
        $env = Environment::createCommonMarkEnvironment();
        $env->addBlockParser(new MetadataBlockParser());
        
        return new static(
            new DocParser($env), new NodeWalker()
        );
    }

    /**
     * @param string $input
     * @return Blueprint
     */
    public function parse($input)
    {
        $document = $this->markdownParser->parse($input);
        $builder = new ASTBuilder();
        $this->nodeWalker->walk($document, $builder);

        return $builder->getAST();
    }

}
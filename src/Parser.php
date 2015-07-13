<?php

namespace Fesor\ApiBlueprint;

use Fesor\ApiBlueprint\AST\Blueprint;
use Fesor\ApiBlueprint\AST\Value\Metadata;
use Fesor\ApiBlueprint\Markdown\Element\MetadataBlock;
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
     * @param DocParser $markdownParser
     */
    public function __construct(DocParser $markdownParser)
    {
        $this->markdownParser = $markdownParser;
    }
    
    public static function create()
    {
        $env = Environment::createCommonMarkEnvironment();
        $env->addBlockParser(new MetadataBlockParser());
        
        return new static(
            new DocParser($env)
        );
    }

    /**
     * @param string $input
     * @return Blueprint
     */
    public function parse($input)
    {
        $document = $this->markdownParser->parse($input);
        $nodeVisitor = new ASTBuilder();
        $this->traverseMarkdownAST($document, $nodeVisitor);

        return $nodeVisitor->getRoot();
    }

    protected function traverseMarkdownAST(AbstractBlock $block, ASTBuilder $nodeVisitor)
    {
//        var_dump(get_class($block));
        if ($block instanceof MetadataBlock) {
            $nodeVisitor->visitMetadata($block);
        }
        if ($block instanceof Paragraph) {
            $nodeVisitor->visitParagraph($block);
        }
        if ($block instanceof Header) {
            $nodeVisitor->visitHeader($block);
        }
        if ($block instanceof ListBlock) {
            $nodeVisitor->visitList($block);
        }

        $children = $block->getChildren();
        foreach ($children as $childBlock) {
            $this->traverseMarkdownAST($childBlock, $nodeVisitor);
        }
    }

}
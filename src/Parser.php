<?php

namespace Fesor\ApiBlueprint;

use Fesor\ApiBlueprint\AST\Blueprint;
use Fesor\ApiBlueprint\AST\Value\Metadata;
use League\CommonMark\Block\Element\AbstractBlock;
use League\CommonMark\Block\Element\Paragraph;
use League\CommonMark\DocParser;

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

    /**
     * @param string $input
     * @return Blueprint
     */
    public function parse($input)
    {
        $blueprint = new Blueprint();
        $document = $this->markdownParser->parse(
            $this->parseMetadata($input, $blueprint)
        );
        $nodeVisitor = new ASTBuilder($blueprint);
        $this->traverseMarkdownAST($document, $nodeVisitor);

        return $nodeVisitor->getRoot();
    }

    protected function traverseMarkdownAST(AbstractBlock $block, ASTBuilder $nodeVisitor)
    {
        if ($block instanceof Paragraph) {
            $nodeVisitor->visitParagraph($block);
        }

        $children = $block->getChildren();
        foreach ($children as $childBlock) {
            $this->traverseMarkdownAST($childBlock, $nodeVisitor);
        }
    }
    
    private function parseMetadata($input, Blueprint $root)
    {
        $lines = preg_split('/\r\n|\n|\r/', $input);
        $offset = 0;
        foreach ($lines as $idx => $line) {
            if ('' === trim($line)) continue;
            
            if (false === ($div = mb_strpos($line, ':')) || $div === mb_strlen(trim($line)) - 1) {
                break;
            }

            $offset++;
            $name = trim(substr($line, 0, $div));
            $value = trim(substr($line, $div + 1));
            $root->metadata[] = Metadata::create($name, $value);
        }
        
        return implode("\n", array_slice($lines, $offset));
    }
}
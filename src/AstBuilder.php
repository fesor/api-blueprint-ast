<?php

namespace Fesor\ApiBlueprint;

use Fesor\ApiBlueprint\AST\Blueprint;
use Fesor\ApiBlueprint\AST\Value\Metadata;
use Fesor\ApiBlueprint\Markdown\Element\MetadataBlock;
use League\CommonMark\Block\Element\AbstractBlock;
use League\CommonMark\Block\Element\Header;
use League\CommonMark\Block\Element\ListBlock;
use League\CommonMark\Block\Element\Paragraph;

class ASTBuilder
{
    /**
     * @var Blueprint
     */
    private $root;

    private $context;
    
    private $passedNodes;

    public function __construct()
    {
        $this->root = new Blueprint();
        $this->context = $this->root;
        $this->passedNodes = [];
    }

    /**
     * @return Blueprint
     */
    public function getRoot()
    {
        $this->handleContextDescription();
        
        return $this->root;
    }

    /**
     * @param Paragraph $paragraph
     */
    public function visitParagraph(Paragraph $paragraph)
    {
        $this->passedNodes[] = $paragraph;
    }

    /**
     * @param Header $header
     */
    public function visitHeader(Header $header)
    {
        if ($this->canHaveName()) {
            $this->context->name = $header->getStringContent();
        } else {
            $this->passedNodes[] = $header;
        }
    }
    
    /**
     * @param ListBlock $list
     */
    public function visitList(ListBlock $list)
    {
        
    }
    
    public function visitMetadata(MetadataBlock $metadata)
    {
        $this->root->metadata[] = $metadata->convertToMetadata();
    }
    
    private function canHaveName()
    {
        return isset($this->context->name) && '' === $this->context->name && 0 === count($this->passedNodes);
    }

    private function handleContextDescription()
    {        
        $this->context->description = implode("\n\n", array_map(function (AbstractBlock $block) {
            return implode("\n", $block->getStrings());
        }, $this->passedNodes));
        $this->passedNodes = [];
    }

}
<?php

namespace Fesor\ApiBlueprint\Markdown;

use Fesor\ApiBlueprint\Markdown\Element\MetadataBlock;
use League\CommonMark\Block\Element\AbstractBlock;
use League\CommonMark\Block\Element\Document;
use League\CommonMark\Block\Element\FencedCode;
use League\CommonMark\Block\Element\Header;
use League\CommonMark\Block\Element\IndentedCode;
use League\CommonMark\Block\Element\ListItem;
use League\CommonMark\Block\Element\Paragraph;

class NodeWalker
{
    
    public function walk(AbstractBlock $node, NodeVisitor $visitor)
    {
        $this->visitNode($node, $visitor);
        foreach ($node->getChildren() as $child) {
            $this->walk($child, $visitor);
        }
        $this->leaveNode($node, $visitor);
    }
    
    public function visitNode(AbstractBlock $node, NodeVisitor $visitor)
    {
        if ($node instanceof Document) {
            $visitor->visitDocument($node);
        }
        if ($node instanceof MetadataBlock) {
            $visitor->visitMetadata($node);
        }
        if ($node instanceof Header) {
            $visitor->visitHeader($node);
        }
        if ($node instanceof ListItem) {
            $visitor->visitList($node);
        }
        if ($node instanceof Paragraph) {
            $visitor->visitParagraph($node);
        }
        if ($node instanceof FencedCode) {
            $visitor->visitFencedCode($node);
        }
        if ($node instanceof IndentedCode) {
            $visitor->visitIndentedCode($node);
        }
    }
    
    public function leaveNode(AbstractBlock $node, NodeVisitor $visitor)
    {
        if ($node instanceof Document) {
            $visitor->leaveDocument($node);
        }
        if ($node instanceof MetadataBlock) {
            $visitor->leaveMetadata($node);
        }
        if ($node instanceof Header) {
            $visitor->leaveHeader($node);
        }
        if ($node instanceof ListItem) {
            $visitor->leaveList($node);
        }
        if ($node instanceof Paragraph) {
            $visitor->leaveParagraph($node);
        }
        if ($node instanceof FencedCode) {
            $visitor->leaveFencedCode($node);
        }
        if ($node instanceof IndentedCode) {
            $visitor->leaveIndentedCode($node);
        }
    }
    
}
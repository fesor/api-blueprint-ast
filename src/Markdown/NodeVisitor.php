<?php

namespace Fesor\ApiBlueprint\Markdown;

use Fesor\ApiBlueprint\AST\Header;
use Fesor\ApiBlueprint\Markdown\Element\MetadataBlock;
use League\CommonMark\Block\Element\Document;
use League\CommonMark\Block\Element\FencedCode;
use League\CommonMark\Block\Element\IndentedCode;
use League\CommonMark\Block\Element\ListItem;
use League\CommonMark\Block\Element\Paragraph;

abstract class NodeVisitor
{
    
    public function visitDocument(Document $node)
    {
    }
    
    public function leaveDocument(Document $node)
    {
    }

    public function visitHeader(Header $header)
    {
    }
    public function leaveHeader(Header $header)
    {
    }
    
    public function visitParagraph(Paragraph $node)
    {
    }
    
    public function leaveParagraph(Paragraph $node)
    {
    }

    public function visitMetadata(MetadataBlock $node)
    {
    }

    public function leaveMetadata(MetadataBlock $node)
    {
    }
    
    public function visitList(ListItem $node)
    {
    }
    
    public function leaveList(ListItem $node)
    {
    }
    
    public function visitFencedCode(FencedCode $node)
    {
    }
    
    public function leaveFencedCode(FencedCode $node)
    {
    }
    
    public function visitIndentedCode(IndentedCode $node)
    {
    }
    
    public function leaveIndentedCode(IndentedCode $node)
    {
    }
    
}
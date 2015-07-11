<?php

namespace Fesor\ApiBlueprint;

use Fesor\ApiBlueprint\AST\Blueprint;
use Fesor\ApiBlueprint\AST\Value\Metadata;
use League\CommonMark\Block\Element\Paragraph;

class ASTBuilder
{
    /**
     * @var Blueprint
     */
    private $root;

    public function __construct(Blueprint $root)
    {
        $this->root = $root;
    }

    /**
     * @return Blueprint
     */
    public function getRoot()
    {
        return $this->root;
    }

    /**
     * @param Paragraph $paragraph
     */
    public function visitParagraph(Paragraph $paragraph)
    {
    }

}
<?php

namespace Fesor\ApiBlueprint\Markdown\Element;

use Fesor\ApiBlueprint\AST\Value\Metadata;
use League\CommonMark\Block\Element\AbstractBlock;
use League\CommonMark\Block\Element\Document;
use League\CommonMark\ContextInterface;
use League\CommonMark\Cursor;

class MetadataBlock extends AbstractBlock
{

    /**
     * @var string
     */
    private $name;

    /**
     * @var string
     */
    private $value;

    /**
     * @param string $name
     * @param string $value
     */
    public function __construct($name, $value)
    {
        $this->name = $name;
        $this->value = $value;
    }


    /**
     * @inheritdoc
     */
    public function canContain(AbstractBlock $block)
    {
        return false;
    }

    /**
     * @inheritdoc
     */
    public function acceptsLines()
    {
        return true;
    }

    /**
     * @inheritdoc
     */
    public function isCode()
    {
        return false;
    }

    public function getChildren()
    {
        return [];
    }

    /**
     * @inheritdoc
     */
    public function matchesNextLine(Cursor $cursor)
    {
        return false;
    }

    /**
     * @inheritdoc
     */
    public function handleRemainingContents(ContextInterface $context, Cursor $cursor)
    {

    }
    
    public function convertToMetadata()
    {
        $metadata =  new Metadata();
        $metadata->name = $this->name;
        $metadata->value = $this->value;
        
        return $metadata;
    }

}
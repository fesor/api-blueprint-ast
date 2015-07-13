<?php

namespace Fesor\ApiBlueprint\Markdown\Parser;

use Fesor\ApiBlueprint\Markdown\Element\MetadataBlock;
use League\CommonMark\Block\Element\Document;
use League\CommonMark\Block\Parser\AbstractBlockParser;
use League\CommonMark\ContextInterface;
use League\CommonMark\Cursor;

class MetadataBlockParser extends AbstractBlockParser
{
    /**
     * @inheritdoc
     */
    public function parse(ContextInterface $context, Cursor $cursor)
    {
        if ($this->isMetadataSectionParsed($context) || !$context->getContainer() instanceof Document) {
            return false;
        }
        
        $cursorState = $cursor->saveState();
        $pair = $cursor->match('/^[^:]+:.+$/');
        if (is_null($pair)) {
            $cursor->restoreState($cursorState);
            return false;
        }

        $pair = explode(':', $pair, 2);
        
        $context->addBlock(new MetadataBlock(trim($pair[0]), trim($pair[1])));
        $context->setBlocksParsed(true);
        
        return true;
    }

    private function isMetadataSectionParsed(ContextInterface $context)
    {
        foreach ($context->getDocument()->getChildren() as $block) {
            if (!$block instanceof MetadataBlock) {
                return true;
            }
        }
        
        return false;
    }

}
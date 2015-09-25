<?php

namespace Fesor\ApiBlueprint;

use League\CommonMark\Block\Parser as BlockParser;
use League\CommonMark\Inline\Parser as InlineParser;
use League\CommonMark\Extension\Extension;

class ApiBlueprintExtension extends Extension
{
    /**
     * @inheritdoc
     */
    public function getBlockParsers()
    {
        return [
            new BlockParser\FencedCodeParser(),
            new BlockParser\IndentedCodeParser(),
            new BlockParser\ListParser(),
            new BlockParser\ATXHeaderParser(),
            new BlockParser\SetExtHeaderParser(),
        ];
    }

    /**
     * @inheritdoc
     */
    public function getInlineParsers()
    {
        return [
            new InlineParser\BacktickParser()
        ];
    }

    /**
     * @inheritdoc
     */
    public function getName()
    {
        return 'api_blueprint';
    }

}
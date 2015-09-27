<?php

namespace Fesor\ApiBlueprint\Processor;

use Fesor\ApiBlueprint\BlueprintBuilder;
use League\CommonMark\Block\Element\AbstractBlock;

interface Processor
{
    /**
     * Checks is processor supports given markdown entity
     *
     * @param AbstractBlock $node
     * @return bool
     */
    public function supportsMarkdownEntity(AbstractBlock $node);

    /**
     * Processes markdown entity
     *
     * @param AbstractBlock $node
     * @param BlueprintBuilder $builder
     * @return bool
     */
    public function process(AbstractBlock $node, BlueprintBuilder $builder);

    /**
     * Returns priority for node processor
     *
     * @return int
     */
    public function priority();
}
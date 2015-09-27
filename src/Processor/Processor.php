<?php
/**
 * Created by IntelliJ IDEA.
 * User: fesor
 * Date: 9/27/15
 * Time: 18:56
 */
namespace Fesor\ApiBlueprint\Processor;

use Fesor\ApiBlueprint\BlueprintBuilder;
use League\CommonMark\Block\Element\AbstractBlock;

interface Processor
{
    /**
     * Checks is processor supports given markdown node
     *
     * @param AbstractBlock $node
     * @return bool
     */
    public function supportsMarkdownEntity(AbstractBlock $node);

    /**
     * Processes markdown node
     *
     * @param AbstractBlock $node
     * @return bool
     */
    public function process(AbstractBlock $node, BlueprintBuilder $blueprint);

    /**
     * Returns priority for node processor
     *
     * @return int
     */
    public function priority();
}
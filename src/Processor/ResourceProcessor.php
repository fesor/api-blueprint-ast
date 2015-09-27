<?php

namespace Fesor\ApiBlueprint\Processor;

use Fesor\ApiBlueprint\BlueprintBuilder;
use League\CommonMark\Block\Element\AbstractBlock;
use League\CommonMark\Block\Element\Header;

class ResourceProcessor implements Processor
{

    const HTTP_REQUEST_METHODS = '(GET|POST|PUT|DELETE|OPTIONS|PATCH|PROPPATCH|LOCK|UNLOCK|COPY|MOVE|MKCOL|HEAD|LINK|UNLINK|CONNECT)';

    /**
     * @inheritdoc
     */
    public function supportsMarkdownEntity(AbstractBlock $node)
    {
        return $node instanceof Header && 1 === count($node->getStrings());
    }

    /**
     * @inheritdoc
     */
    public function process(AbstractBlock $node, BlueprintBuilder $builder)
    {
        $strings = $node->getStrings();

        $regex = strtr('/^((HTTP_METHODS\s+|)(\/.+)|(.+?)\s+\[((HTTP_METHODS\s+|)(\/.+)|HTTP_METHODS)\])$/', [
            'HTTP_METHODS' => self::HTTP_REQUEST_METHODS
        ]);

        if (!preg_match($regex, $strings[0], $matches)) {

            return false;
        }

        $definition = $this->processDefinition($matches);

        if ($definition->isAction) {
            $builder->addAction($definition->method, $definition->name, $definition->uriTemplate);
        } else {
            $builder->addResource($definition->name, $definition->uriTemplate);
        }

        return true;
    }

    /**
     * @inheritdoc
     */
    public function priority()
    {
        return 100;
    }

    /**
     * @param array $matches
     * @return object
     */
    private function processDefinition(array $matches)
    {
        $name = '';
        if (10 <= count($matches)) {
            $name = $matches[5];
            $uriTemplate = '';
            if (10 === count($matches)) {
                $method = $matches[8];
                $uriTemplate = $matches[9];
            } else {
                $method = $matches[10];
            }
        } else {
            $method = $matches[3];
            $uriTemplate = $matches[4];
        }
        $isAction = !empty($method);

        return (object) compact('isAction', 'name', 'method', 'uriTemplate');
    }
}
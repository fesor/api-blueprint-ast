<?php

namespace Fesor\ApiBlueprint;

use Fesor\ApiBlueprint\Element\Action;
use Fesor\ApiBlueprint\Element\Category;
use Fesor\ApiBlueprint\Element\Element;
use Fesor\ApiBlueprint\Element\Resource;
use Fesor\ApiBlueprint\Exception\ContextStackException;

class BlueprintBuilder
{

    /**
     * @var ContextStack
     */
    private $contextStack;

    /**
     * @param ContextStack $contextStack
     */
    public function __construct(ContextStack $contextStack)
    {
        $this->contextStack = $contextStack;
    }

    /**
     * @param string $name
     * @param string $value
     */
    public function addMetadata($name, $value)
    {
        $this->contextStack->getContext()->addMetadata($name, $value);
    }

    /**
     * @param string $name
     */
    public function addResourceGroup($name = '')
    {
        $this->contextStack->restoreContextToRootElement();
        $resourceGroup = Category::createNamedCategory($name);
        $this->contextStack->getContext()->addContent($resourceGroup);
        $this->contextStack->pushContext($resourceGroup);
    }

    /**
     * @param string $name
     * @param string $urlTemplate
     */
    public function addResource($name = '', $urlTemplate = '')
    {
        if ($this->failToResetContextToType(Element::TYPE_CATEGORY)) {
            $this->addResourceGroup();
        }

        $this->contextStack->getContext()->addContent(new Resource($name, $urlTemplate));
    }

    /**
     * @param string $method
     * @param string $name
     * @param string $urlTemplate
     */
    public function addAction($method, $name = '', $urlTemplate = '')
    {
        if ($this->failToResetContextToType(Element::TYPE_RESOURCE)) {
            $this->addResource();
        }

        $this->contextStack->getContext()->addContent(new Action($method, $name, $urlTemplate));
    }

    /**
     * @param string $type
     * @return bool
     */
    private function failToResetContextToType($type)
    {
        try {
            $this->contextStack->restoreContextToElementOfType($type);
        } catch (ContextStackException $e) {
            return true;
        }

        return false;
    }

}
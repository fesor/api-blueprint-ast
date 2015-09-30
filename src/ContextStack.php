<?php

namespace Fesor\ApiBlueprint;

use Fesor\ApiBlueprint\Element\Element;

class ContextStack
{

    /**
     * @var Element
     */
    private $context;

    /**
     * @var Element[]
     */
    private $contextStack;

    /**
     * BuilderContext constructor.
     * @param Element $context
     */
    public function __construct(Element $context)
    {
        $this->context = $context;
        $this->contextStack = [];
    }

    /**
     * @return Element
     */
    public function getContext()
    {
        return $this->context;
    }

    /**
     * @param Element $context
     */
    public function pushContext(Element $context)
    {
        $this->contextStack[] = $this->context;
        $this->context = $context;
    }

    /**
     * @return Element
     */
    public function popContext()
    {
        $context =  $this->context;
        $this->context = array_pop($this->contextStack);

        return $context;
    }

    /**
     * @param Element $element
     */
    public function restoreContextTo(Element $element)
    {
        while($this->context && $element !== $this->context) {
            $this->popContext();
        }

        if (!$this->context) {
            throw new \LogicException('Unable to restore context');
        }
    }

    /**
     * @param string $elementType
     */
    public function restoreContextToElementOfType($elementType)
    {
        while($this->context && $this->context->getElementType() !== $elementType) {
            $this->popContext();
        }

        if (!$this->context) {
            throw new \LogicException(
                sprintf('Unable to restore context to element of type "%s"', $elementType)
            );
        }
    }

    public function restoreContextToRootElement()
    {
        $this->context = reset($this->contextStack);
        $this->contextStack = [];
    }

}

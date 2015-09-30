<?php
/**
 * Created by PhpStorm.
 * User: fesor
 * Date: 10/1/15
 * Time: 02:32
 */

namespace Fesor\ApiBlueprint\Element;


class Action extends NamedElement
{
    /**
     * @var string
     */
    private $method;

    /**
     * Action constructor.
     * @param string $method
     * @param string $name
     * @param string $uriTemplate
     */
    public function __construct($method, $name, $uriTemplate = '')
    {
        $this->method = $method;
        $this->setName($name);
        $this->setAttribute('uriTemplate', $uriTemplate);
        $this->setAttribute('relation', '');
    }

    public function getElementType()
    {
        return 'action';
    }
}
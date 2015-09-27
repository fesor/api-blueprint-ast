<?php

namespace Fesor\ApiBlueprint;

use Fesor\ApiBlueprint\Element\Blueprint;

class BlueprintBuilder
{

    private $blueprint;

    /**
     * @param Blueprint $blueprint
     */
    public function __construct(Blueprint $blueprint)
    {
        $this->blueprint = $blueprint;
    }

    /**
     * @param string $name
     * @param string $value
     */
    public function addMetadata($name, $value)
    {
        $this->blueprint->addMetadata($name, $value);
    }

    public function addResourceGroup($name = '')
    {

    }

    public function addResource($name = '', $urlTemplate = '')
    {

    }

    public function addAction($method, $name = '', $urlTemplate = '')
    {

    }

}
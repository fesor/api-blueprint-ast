<?php

namespace Fesor\ApiBlueprint\Element;

class Category extends Element
{
    /**
     * @param string $name
     * @return static
     */
    public static function createNamedCategory($name = '')
    {
        $category = new static();
        if (!empty($name)) {
            $category->attributes['name'] = $name;
        }

        return $category;
    }

    /**
     * @inheritdoc
     */
    public function getElementType()
    {
        return self::TYPE_CATEGORY;
    }


}
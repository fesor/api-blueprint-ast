<?php

use Evenement\EventEmitterInterface;
use Peridot\Scope\Scope;
use Fesor\ApiBlueprint\BlueprintParser;
use Fesor\ApiBlueprint\MarkdownParser;

class FunctionalScope extends Scope 
{
    
    private $parser;

    public function __construct(BlueprintParser $parser)
    {
        $this->parser = $parser;
    }

    public function ASTof($blueprint)
    {
        return Fesor\JsonMatcher\JsonMatcher::create(
            $this->parser->parse($blueprint)
        );
    }
}

return function (EventEmitterInterface $emitter) {

    $emitter->on('test.start', function ($test) {
        $test->getScope()->peridotAddChildScope(new FunctionalScope(
            new BlueprintParser(
                new MarkdownParser()
            )
        ));
    });
};

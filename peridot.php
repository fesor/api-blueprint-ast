<?php

use Evenement\EventEmitterInterface;
use Peridot\Scope\Scope;
use Fesor\ApiBlueprint\Parser;
use League\CommonMark\Environment;
use League\CommonMark\DocParser;

class FunctionalScope extends Scope 
{
    
    private $parser;

    public function __construct( $parser)
    {
        $this->parser = $parser;
    }

    public function jsonRepresentationOf($blueprint)
    {
        return Fesor\JsonMatcher\JsonMatcher::create(
            json_encode($this->parser->parse($blueprint))
        );
    }
}

return function (EventEmitterInterface $emitter) {

    $emitter->on('test.start', function ($test) {
        $test->getScope()->peridotAddChildScope(new FunctionalScope(
            new Parser(
                new DocParser(new Environment())
            )
        ));
    });
};

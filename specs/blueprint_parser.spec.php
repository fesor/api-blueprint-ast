<?php

describe('Parser should provide correct AST for blueprint', function () {

    it('produces empty AST on empty document', function () {

        $this
            ->jsonRepresentationOf('')
            ->equal('{
                "_version": "3.0",
                "name": "",
                "description": "",
                "element": "category",
                "metadata": [],
                "content": []
            }');
    });

    context('Metadata parsing', function () {

        it('parses blueprint\'s metadata', function () {

            $blueprintA = <<<EOT
FORMAT: 1A
HOST: http://example.com
EOT;
            $blueprintB = <<<EOT
FORMAT: 1A

HOST: http://example.com
EOT;
            $blueprintC = <<<EOT
FORMAT: 1A

HOST: http://example.com

Foo
EOT;

            foreach ([$blueprintA, $blueprintB, $blueprintC] as $blueprint) {
                $this
                    ->jsonRepresentationOf($blueprint)
                    ->equal('[
                        {"name": "FORMAT", "value": "1A"},
                        {"name": "HOST", "value": "http://example.com"}
                    ]', ['at' => 'metadata']);
            }

        });

        it('correctly handles metadata breaks', function () {

            $blueprintA = <<<EOT
Foo: foo value
Bar
EOT;
            $blueprintB = <<<EOT
Foo
Bar: bar value
EOT;
            $blueprintC = <<<EOT
Foo

Bar: bar value
EOT;
            $blueprintD = <<<EOT
Foo:
EOT;

            $cases = [
                $blueprintA => [['name'=> 'Foo', 'value' => 'foo value']],
                $blueprintB => [],
                $blueprintC => [],
                $blueprintD => [],
            ];

            foreach ($cases as $blueprint => $result) {
                $this
                    ->jsonRepresentationOf($blueprint)
                    ->equal(json_encode($result), ['at' => 'metadata']);
            }
        });

    });
    
    context('Name and description parsing', function () {
        
        it('Parses blueprint name and description', function () {

            $blueprint = <<<EOT
Foo: bar
Blueprint Name
====================

blueprint description
EOT;

            $this
                ->jsonRepresentationOf($blueprint)
                ->equal('{
                    "metadata": [{"name": "Foo", "value": "bar"}],
                    "name": "Blueprint Name",
                    "description": "blueprint description"
                }', ['excluding' => ['_version', 'content', 'element']]);

        });
        
        it('Correctly handles multi-paragraph description ', function () {
            $blueprint = <<<EOT
foo

bar
EOT;

            $this
                ->jsonRepresentationOf($blueprint)
                ->equal('"foo\n\nbar"', ['at' => 'description']);
        });
        
    });

});

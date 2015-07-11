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
    
});
<?php

namespace Traits;

trait FileSystem {
    protected function createOrUpdateFile(string $filename, string $content){
        file_put_contents($filename, $content);
    }

    protected function getLinesOfFile($filename){
        if(!is_readable($filename))
            throw new \Exception('Arquivo não existe');

        $fileLines = array_map(function($line){
            return str_replace("\n", "", $line);
        }, file($filename));
        return $fileLines;
    }
}


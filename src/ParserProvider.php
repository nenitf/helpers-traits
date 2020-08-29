<?php

namespace NativeProviders;

class ParserProvider {
    public function parseCsvFile(string $filename, string $delimeter){
        if(!is_readable($filename))
            throw new \Exception('Arquivo não encontrado');

        $csv = array_map(function($line) use ($delimeter){
            $line = str_replace("\n", "", $line);
            return explode($delimeter, $line);
        }, file($filename));

        return $csv;
    }
}

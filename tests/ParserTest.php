<?php

namespace Tests;

/**
 * @coversDefaultClass \Traits\Parser
 */
class ParserTest extends \Tests\TestCase {
    public function newParser(){
        return $this->newTrait('\Traits\Parser');
    }

    /**
     * @covers ::parseCsvFile
     */
    public function testDeveLerArquivoCsv() {
        $csv = __DIR__ . DIRECTORY_SEPARATOR . 'projetos.csv';

        if(file_exists($csv))
            unlink($csv);

        $conteudo = "123;exemplo de titulo\n45454;outro titulo";
        file_put_contents($csv, $conteudo);

        $parser = $this->newParser();
        $conteudo = $parser->parseCsvFile($csv, ";");

        if(file_exists($csv))
            unlink($csv);

        $this->assertEquals($conteudo, [
            ['123', 'exemplo de titulo'],
            ['45454', 'outro titulo'],
        ]);
    }

    /**
     * @covers ::parseCsvFile
     */
    public function testDeveDarErroAoNaoAcharArquivoCsv() {
        $csv = __DIR__ . DIRECTORY_SEPARATOR . 'arquivo-inexistente.csv';

        $parser = $this->newParser();

        $this->expectExceptionMessage('Arquivo não encontrado');
        $conteudo = $parser->parseCsvFile($csv, ";");
    }
}


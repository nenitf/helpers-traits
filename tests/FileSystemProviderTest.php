<?php

namespace Tests;

/**
 * @coversDefaultClass \NativeProviders\FileSystemProvider
 */
class FileSystemProviderTest extends \Tests\TestCase {
    public function newFileSystem(){
        return $this->new('\NativeProviders\FileSystemProvider');
    }

    /**
     * @covers ::createOrUpdateFile
     */
    public function testDeveCriarArquivoCasoNaoExista() {
        $arquivo = __DIR__ . DIRECTORY_SEPARATOR . 'arquivo-existente.txt';

        if(file_exists($arquivo))
            unlink($arquivo);

        $conteudo = "aa";

        $filesystem = $this->newFileSystem();
        $filesystem->createOrUpdateFile($arquivo, $conteudo);

        $conteudoReal = file_get_contents($arquivo);

        if(file_exists($arquivo))
            unlink($arquivo);

        $this->assertEquals($conteudo, $conteudoReal);
    }

    /**
     * @covers ::createOrUpdateFile
     */
    public function testDeveAtualizarArquivoCasoExista() {
        $arquivo = __DIR__ . DIRECTORY_SEPARATOR . 'arquivo-existente.txt';

        if(file_exists($arquivo))
            unlink($arquivo);

        $conteudo = "aa";
        $filesystem = $this->newFileSystem();
        $filesystem->createOrUpdateFile($arquivo, $conteudo);
        $conteudoReal = file_get_contents($arquivo);
        $this->assertEquals($conteudo, $conteudoReal);

        $conteudo = "bb";
        $filesystem = $this->newFileSystem();
        $filesystem->createOrUpdateFile($arquivo, $conteudo);
        $conteudoReal = file_get_contents($arquivo);

        if(file_exists($arquivo))
            unlink($arquivo);

        $this->assertEquals($conteudo, $conteudoReal);
    }

    /**
     * @covers ::getLinesOfFile
     */
    public function testDeveDarErroAoNaoAcharArquivo() {
        $arquivo = __DIR__ . DIRECTORY_SEPARATOR . 'arquivo-inexistente.txt';

        $filesystem = $this->newFileSystem();

        $this->expectExceptionMessage('Arquivo não existe');

        $filesystem->getLinesOfFile($arquivo);
    }

    /**
     * @covers ::getLinesOfFile
     */
    public function testDeveRetornarLinhasComoArray() {
        $arquivo = __DIR__ . DIRECTORY_SEPARATOR . 'arquivo.txt';

        $conteudo = "Exemplo\ncom\nmultiplas linhas.";
        file_put_contents($arquivo, $conteudo);

        $filesystem = $this->newFileSystem();

        $lines = $filesystem->getLinesOfFile($arquivo);

        $this->assertEquals($lines, [
            "Exemplo", "com", "multiplas linhas."
        ]);
    }
}

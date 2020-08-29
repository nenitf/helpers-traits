# DevToU

[![emojicom](https://img.shields.io/badge/emojicom-%F0%9F%90%9B%20%F0%9F%86%95%20%F0%9F%92%AF%20%F0%9F%91%AE%20%F0%9F%86%98%20%F0%9F%92%A4-%23fff)](https://gist.github.com/nenitf/1cf5182bff009974bf436f978eea1996#emojicom)

Biblioteca de providers que simplificam o desenvolvimento e facilitam a testabilidade do código.

## Motivo

- É mais fácil mockar métodos do que endpoints e arquivos.
- Simplificar algumas atividades comuns, como requisições e parsers.

## Download

```sh
curl https://raw.githubusercontent.com/nenitf/native-providers/main/src/HttpClientProvider.php -o HttpClientProvider.php
curl https://raw.githubusercontent.com/nenitf/native-providers/main/src/ParserProvider.php -o ParserProvider.php
curl https://raw.githubusercontent.com/nenitf/native-providers/main/src/FileSystemProvider.php -o FileSystemProvider.php
```

## Testes

```sh
composer test
composer test:cover

# para testar a HttpClient é necessário levantar o servidor fake
# em um segundo terminal ANTES da execução
#composer test:start-server
#composer test
```

## Contribuindo

Veja o [CONTRIBUTING.md](CONTRIBUTING.md)

### Escopos dos commits

- Podem ser obrigatórios para `:bug:`, `:new:`, `:100:` e `:cop:`, caso o commit seja específico de um provider. Exemplo: `:new:(HttpClient) add metodo post`.

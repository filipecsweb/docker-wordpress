## Links Úteis

* Bootstrap 4   
https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.css
* Icomoon   
https://icomoon.io/app/#/projects
* Coolors   
https://coolors.co/u/filipecsweb

## Pré-desenvolvimento

- [ ] Domínio;
- [ ] Logo;
- [ ] Favicon;
- [ ] Fontes;
- [ ] Mapa do site.

## Instalação, configuração e desenvolvimento iniciais

- [ ]  Cria subdomínio no arquivo hosts: `sudo nano /etc/hosts`.
- [ ]  Executa wp-setup.sh na raiz do projeto.
- [x]  Redefine os salts: `wp config shuffle-salts`.
- [x]  Configura: o arquivo `.env`, o arquivo `package.json`, o Nginx.
- [x]  Inicia o Docker pela primeira vez: `docker stop -t 0 $(docker ps -q); docker-compose up --force-recreate`.
- [x]  Instala Webpack e outras dependências: `npm install`.
- [x]  Acessa o site pela primeira vez e finaliza a instalação.
- [x]  Instala os plugins.
- [x]  Renomeia categoria padrao e deleta conteudo inutil: temas, posts e comentários.
- [x]  Acessa Configurações e seus subitens e define opções convenientes ao site.
- [x]  Ativa o tema.
- [ ]  Atualiza paleta de cores ([https://gist.github.com/filipecsweb/71245fd0312882c57c90a960c7f68d2a](https://gist.github.com/filipecsweb/71245fd0312882c57c90a960c7f68d2a)).
- [ ]  Cria projeto em [https://icomoon.io/app](https://icomoon.io/app).
- [ ]  Insere logo e favicon.
- [ ]  Importa grupos de campos do ACF e customiza se necessário.
- [ ]  Cria todas as páginas.
- [ ]  Inicia desenvolvimento: `npm run watch`.
- [ ]  Constrói cabeçalho e rodapé.

## Lançamento

> Comece assim que o site for ao ar.

- [ ]  Resolve `@TODOs` em aberto no código;
- [ ]  Carrega icomoon localmente;
- [ ]  Define `WP_DEBUG` como *false*. Revisa outras constantes no arquivo `wp-config.php`;
- [ ]  Remove *mapping* dos assets;
- [ ]  Cria/altera robots.txt;
- [ ]  Testa todos os formulários de contato;
- [ ]  Altera permissão de arquivos: `find . -type d -exec chmod 755 {} \; && find . -type f -exec chmod 644 {} \;`.

## S.E.O.

- [ ] Validar responsividade: https://search.google.com/test/mobile-friendly;
- [ ] Verificar se nota de otimização para Desktop está acima de 85: https://developers.google.com/speed/pagespeed/insights/.

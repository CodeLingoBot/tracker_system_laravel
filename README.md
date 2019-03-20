# auto_rest_laravel
Sistema de Rastreamento Veicular

# Configuração do servidor
Rodar comandos ubuntu:
- sudo apt-get install lamp-server^
- sudo apt-get install git
- sudo apt-get install composer

# Configuração desenvolvimento
- Clonar repositório
- Instalar ruby 2.6.1p33
- Executar: bundle install
- Copiar arquivo .env para .env.example
- Executar: php composer install
- Executar: php artisan key:generate

# Configuração para deploy
## .env
Configurar as seguintes chaves:

**DEPLOY_REPO**=URL SSH do GIT
**DEPLOY_TO**=Pasta para quais os arquivos irão automaticamente
**DEPLOY_PROD_HOST**=IP ou DNS do Servidor para qual irá o deploy
**DEPLOY_PROD_USER**=Usuário da máquina com permissões para deploy
**DEPLOY_PROD_PASS**=Senha do Usuário acima

## Capistrano
- Testar: Executar no projeto 'cap production deploy:check'
- Deploy: Executar no projeto 'cap production deploy'
# tracker_system_laravel
Sistema de Rastreamento Veicular

# Configuração básica do servidor e máquina de desenvolvimento

Ubuntu:
- sudo apt install lamp-server^
- sudo apt install git
- sudo apt install composer
- sudo apt install php-mbstring php-xml
- sudo apt install acl

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

- **DEPLOY_REPO**=URL SSH do GIT
- **DEPLOY_TO**=Pasta para quais os arquivos irão automaticamente
- **DEPLOY_PROD_HOST**=IP ou DNS do Servidor para qual irá o deploy
- **DEPLOY_PROD_USER**=Usuário da máquina com permissões para deploy
- **DEPLOY_PROD_PASS**=Senha do Usuário acima

## Capistrano
- Para testar executar: 'cap production deploy:check'
- Para deploy executar: 'cap production deploy'

## Configuração .env em produção caso primeira instalação
- Na pasta 'shared' após o primeiro deploy, criar o arquivo .env e adicionar a parte relacionada apenas ao Laravel.
- Configurar apache para apontar para a pasta 'current' do deploy.

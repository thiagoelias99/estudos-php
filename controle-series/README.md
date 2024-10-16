# Aluraplay

Curso de Laravel com foco no padrão MVC onde foi desenvolvido um controle de series.
#### Desenvolvido com php 8.3.12 e Laravel 11.27.2

### Recursos Estudados
- Laravel
- Artisan
- Routes
    - Controller
    - Resource
- Controller
    - Padrão de nomes
    - Request
    - Response
    - Redirect
    - Session
    - Flash Message
    - FormController
        - Validations
- Views
    - Layout
    - Blade
    - Components
    - Forms
    - Bootstrap
- Models
    - Eloquent ORM
    - Relationships
- Database
    - Migrations
    - Relationships
    - Transactions
- Repositories
- Service Container
- Middleware
- Autenticação com session
- Mailer
- Queue
- Listener
- Log
- Upload de arquivos
- Testes automatizados
- API
    - Endpoints
- Autenticação com token

### Execução do App
1. Executar comando ```composer install``` para instalar as dependências.
1. Executar comando ```php artisan migrate``` para criar o banco de dados (sqlite).
1. Executar comando ```php -S localhost:8000 -t public``` para iniciar a aplicação.
1. Executar comando ```php artisan queue:work --tries=3 --delay=10``` para iniciar o listener de jobs.

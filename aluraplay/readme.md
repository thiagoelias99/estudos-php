# Aluraplay

Curso de PHP na web com foco no padrão MVC onde foi desenvolvido um player de vídeos.
#### Desenvolvido com php 8.3.12

### Recursos Estudados
- PHP + HTML
- Banco de dados PDO + SQLite
- Validação de dados
- Front-Controller
- Auto loading
- Entity
- Repository
- Controller
- Views
- Routes
- Login / Logout / Session
- Upload de imagem

### Execução do App
1. Executar as migrations do banco de dados com 
  1.1. ```php migrations/0001_criar_banco.php```
  1.2. ```php migrations/0002_criar_usuarios.php```
  1.3. ```php migrations/0003_add_image.php```
2. Executar comando ```composer install``` para instalar dependências do projeto.
3. Executar comando ```php utils/add-user.php nome_de_usuario senha``` para registrar usuários.
4. Iniciar servidor com ```php -S localhost:8000 -t public```
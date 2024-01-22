# URL SHORTER

## Instalação

### Requerimentos

composer
php 8.2
npm

### Comandos

- ```composer install```

- ```cp .env.example .env```

- Crie um banco de dados e substitua as informações das seguintes variáveis:

- - ```DB_DATABASE```
- - ```DB_USERNAME```
- - ```DB_PASSWORD```

- obs.: no .env criado

- ```php artisan migrate:fresh --seed```

- ```php artisan key:gen```

- ```npm install && npm run build```

- ```php artisan serve```

- Acesse http://localhost:8000 no seu navegador! Utilize as credenciais admin@email.com e 12345678 para logar.


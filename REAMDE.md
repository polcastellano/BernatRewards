Manual de instalación

1 Como usar
    1.1 Clonar Repositorio
        git clone "url del proyecto en GIT"

    1.2 Instalar vía Composer
        composer install

    1.3 Copiar el fichero .env.example a .env edita las credenciales y la url
        Campos a cambiar:
            APP_NAME=TemplateDaw2
            APP_URL=http://localhost:8000
            DB_HOST=127.0.0.1
            DB_PORT=3306
            DB_DATABASE=templateDaw2
            DB_USERNAME=root

    1.4 Generar Application Key
        php artisan key:generate

    1.5 Migrar base de datos
        php artisan migrate

    1.6 Lanzar Seeders
        php artisan db:seed

    1.7 Instalar las dependencias de Node
        npm install
        npm run dev

    1.8 Activar storage para ver las imagenes de ra carpeta public
        php artisan storage:link


2 Clonacion a GIT personal
    2.1 Creación git
        Primero eliminar el origin que hay actualmente 
            Haciendo git remote -v los podemos ver
        Borrar las ramas de origin
            git remote rm origin 
    
    2.2 Seguir estos comandos cada uno con su url del nuevo proyecto del git
        git remote add origin "url a tu nuevo proyecto en GIT"
        git branch -M main
        git push -u origin main
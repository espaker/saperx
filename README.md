# saperx

#### Requisitos ####

* PHP 8 
* Composer

##

### Rodando em modo Dev ###

##### Instale os pacotes do Composer

    composer install

#### Copie a env de exemplo

    cp .env.example .env

#### Gere a chave da aplicação

    php artisan key:generate

#### Ative o Sail

    php artisan sail:publish

#### Suba o Sail

    ./vendor/bin/sail up

#### Abra outro terminal e execute as migrations

    ./vendor/bin/sail artisan migrate

#### Gere os seeders 

    ./vendor/bin/sail artisan db:seed

#### Instale as dependencias do frontend

    ./vendor/bin/sail npm install

#### Suba o frontend

    ./vendor/bin/sail npm run dev

### Pronto Seu localhost está funcional bem [aqui](http://localhost)
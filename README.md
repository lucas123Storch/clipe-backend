# Iniciar Projeto

## COMANDOS:

### Instalar dependencias do composer

```
docker run --rm -u "$(id -u):$(id -g)" -v $(pwd):/opt -w /opt laravelsail/php80-composer:latest composer install --ignore-platform-reqs
```

### Subir containers

```
vendor/bin/sail up -d
```

### Rodar migrações

```
vendor/bin/sail artisan migrate --seed
```

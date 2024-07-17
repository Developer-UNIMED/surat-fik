# Laravel11 Skeleton

Boost application development with Laravel Application Starter. This package provides a simple way to start a new
Laravel application with a set of pre-defined configurations and packages.

## Development

- Clone this repository
- Copy `.env.example.development` file and rename it to `.env`
- Update `.env` file with your local environment settings

```
DB_DATABASE=laravel
DB_USERNAME=root
DB_PASSWORD=
```

- Run below commands

```bash
# install dependencies using composer
composer install

# generate application key
php artisan key:generate

# run migration with seed data
php artisan migrate:fresh --seed
```

- Run application

```bash
php artisan serve
# open browser and navigate to http://127.0.0.1:8000
```

## Deployment Using Script

- Run below commands
-
    - Debian

```bash
# Debian
curl -L "https://gist.githubusercontent.com/akbarhps/8e7d4b3f3e558a5f95c32e990b4decdd/raw/22ba0855f596e76b7aec67831f0e8efdacd07b9a/deploy.debian.sh" -o deploy.sh && chmod +x deploy.sh;
# change "laravel11-skeleton.git" to project repository name
sudo ./deploy.sh "git@github.com:Developer-UNIMED/laravel11-skeleton.git"
```

-
    - Ubuntu

```bash
# Ubuntu
curl -L "https://gist.githubusercontent.com/akbarhps/abf6b219e5d58d77541f29f3303f0cee/raw/99771ea74a4b481700d208f28cc314952478a799/deploy.ubuntu.sh" -o deploy.sh && chmod +x deploy.sh;
# change "laravel11-skeleton.git" to project repository name
sudo ./deploy.sh "git@github.com:Developer-UNIMED/laravel11-skeleton.git"
```

## Auto deployment using Github Action

- Set Github Action secrets in `Repository > Settings > Secrets and variables > Actions`, and add the following field:

```
SERVER_SSH_HOST
SERVER_SSH_PASSWORD
SERVER_SSH_PORT
SERVER_SSH_USERNAME
```

- Update `deploy.yml` file in `.github/workflows`, and change below environment variables:

```
# change to deployment branch name (example: master)
branches:
  - your_deployment_branch

# choose deployment script based on vm os
script: |
    # Debian
    curl -L "https://gist.githubusercontent.com/akbarhps/8e7d4b3f3e558a5f95c32e990b4decdd/raw/22ba0855f596e76b7aec67831f0e8efdacd07b9a/deploy.debian.sh" -o deploy.sh && chmod +x deploy.sh;
    # change "git@github.com:Developer-UNIMED/laravel11-skeleton.git"
    sudo ./deploy.sh "git@github.com:Developer-UNIMED/laravel11-skeleton.git"

    # Ubuntu
    curl -L "https://gist.githubusercontent.com/akbarhps/abf6b219e5d58d77541f29f3303f0cee/raw/99771ea74a4b481700d208f28cc314952478a799/deploy.ubuntu.sh" -o deploy.sh && chmod +x deploy.sh;
    # change "git@github.com:Developer-UNIMED/laravel11-skeleton.git"
    sudo ./deploy.sh "git@github.com:Developer-UNIMED/laravel11-skeleton.git"
```

- Push changes to deployment branch

Setup Github Repo
=================
git init
git add .
git remote add origin http://github.com/username/git-repo.git
git push -u origin master

Setup Application
=================
npm install
php artisan make:auth

Question Model and Migration
============================
php artisan make:model Question -m
php artisan migrate
define user question relation and set title attributes


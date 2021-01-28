## Table of contents
* [General info](#general-info)
* [Technologies](#technologies)
* [Features](#features)
* [Installation](#installation)
* [Screenshots](#screenshots)

## General info
Symfony/vuex app to explore/view chess games from the database.

## Technologies
Project is created with:
* Symfony 5.2
* Vue/Vuex
* vuex-pagination https://github.com/cyon/vuex-pagination
* Chess.js
* Chessboard.js
* MySQL database

## Features
* displaying paginated clickable games from db
* going through the games with next/prev buttons

## To do
* importing 2 millions games from kingBase database https://archive.org/details/KingBase2018 
* games search
* position search
* how many times position occurs in db
* stockfish.js integration to analyse games

## Installation

install composer dependencies
```
composer install
```
install frontend dependencies
```
yarn install
```
compile assets
```
yarn encore dev
```
run migrations
```
php bin/console doctrine:migrations:migrate
```
load fixtures
```
php bin/console doctrine:fixtures:load
```

## Screenshots
![Main page](public/img/screen1.png)
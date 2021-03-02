## Table of contents
* [General info](#general-info)
* [Architecture](#architecture)
* [Technologies](#technologies)
* [Features](#features)
* [Installation](#installation)
* [Screenshots](#screenshots)

## General info
Symfony/vuex web based demo to explore/view chess games from the database.

## Architecture
Entire front-end is made using Vue.js/Vuex using SPA architecture.
Symfony framework acts as a backend API and is used to communicate with the database.

## Technologies
Project is created with:
* Symfony 5.2
* Vue/Vuex
* vuex-pagination - https://github.com/cyon/vuex-pagination
* Chess.js
* Chess.php - https://github.com/ryanhs/chess.php
* Chessboard.js
* Risendy PGN parser - https://github.com/risendy/pgnParserBundle
* MySQL database

## Features
* importing pgn games into DB from pgn file using symfony command
* displaying paginated games from the db
* going through the games with next/prev buttons
* displaying most popular moves in the current position
* playing the position from the start (useful for opening preparation)
* playing moves from the most popular moves in the position (useful for opening preparation)
* basic filters (white/black player, game result)
* favourite games
* game sorting

## To do
* games searching
* position searching
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
import games from pgn file using symfony command. The file should exists in the public directory.
The command takes one input argument which is a name of the file eg. (games.pgn) 
For bigger files it may take a while (importing about 3 games per second)
```
php bin/console app:import-games --env=prod --no-debug {filename} 
```
if you want to use provided file with around 13k games use:
```
php bin/console app:import-games --env=prod --no-debug KingBase_part_1.pgn 
```

## Screenshots
![Opening book](public/img/screen1.png)
![Game explorer](public/img/screen2.png)
![Filters example](public/img/screen3.png)
![Favourite games](public/img/screen4.png)

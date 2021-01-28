<?php

namespace App\DataFixtures;

use App\Entity\Game;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class AppFixtures extends Fixture
{
    static $gamesArray = [
        [
            'event' => 'Gibraltar Masters 2018',
            'site' => 'Caleta ENG',
            'date' => '2018-01-29',
            'round' => '7.36',
            'white' => 'Tarjan, James E',
            'black' => 'Papp, Gabor',
            'result' => '0-1',
            'white_elo' => '2432',
            'black_elo' => '2607',
            'eco' => 'A20',
            'event_date' => '2018-01-23',
            'pgn' => '1.c4 e5 2.g3 Nf6 3.Bg2 c6 4.d4 Bb4+ 5.Bd2 Bxd2+ 6.Qxd2 d6 7.Nc3 O-O 8.e3 
exd4 9.Qxd4 Nbd7 10.Nf3 Qa5 11.O-O Ne5 12.b3 Bh3 13.Nh4 Bxg2 14.Kxg2 Rfe8 
15.e4 Rad8 16.Rad1 b5 17.cxb5 cxb5 18.Nf5 b4 19.Nd5 Nxd5 20.Qxd5 Qxa2 21.
Rd2 Qa6 22.f4 Ng4 23.Qd4 Nf6 24.e5 Qb7+ 25.Kg1 Ne4 26.exd6 f6 27.Re2 g6 
28.Ne7+ Qxe7 29.dxe7 Rxd4 0-1'
        ],
        [
            'event' => 'Gibraltar Masters 2018',
            'site' => 'Caleta ENG',
            'date' => '2018-01-29',
            'round' => '7.42',
            'white' => 'Pigott, John C',
            'black' => 'Dvirnyy, Danyyil',
            'result' => '0-1',
            'white_elo' => '2418',
            'black_elo' => '2534',
            'eco' => 'A09',
            'event_date' => '2018-01-23',
            'pgn' => '1.Nf3 d5 2.c4 d4 3.b4 g5 4.Qa4+ c6 5.Nxg5 e5 6.d3 Bh6 7.f4 exf4 8.Nf3 Ne7 
9.Bb2 Nf5 10.Nbd2 O-O 11.Nb3 Re8 12.O-O-O a5 13.Kb1 Bg7 14.c5 Be6 15.Rc1 
b5 16.cxb6 Qxb6 17.Nxa5 Na6 18.a3 c5 19.Qc6 Qa7 20.b5 Nc7 21.Nc4 Nxb5 22.
Qxb5 Reb8 23.Qc6 Bxc4 24.Rxc4 Rxb2+ 25.Kxb2 Qxa3+ 26.Kc2 Ne3+ 27.Kd2 Qa5+ 
0-1'
        ],
        [
            'event' => 'Gibraltar Masters 2018',
            'site' => 'Caleta ENG',
            'date' => '2018-01-29',
            'round' => '7.47',
            'white' => 'Batchimeg, Tuvshintugs',
            'black' => 'Kollars, Dmitrij',
            'result' => '1/2-1/2',
            'white_elo' => '2398',
            'black_elo' => '2505',
            'eco' => 'E90',
            'event_date' => '2018-01-23',
            'pgn' => '1.d4 Nf6 2.c4 g6 3.Nc3 Bg7 4.e4 d6 5.Nf3 O-O 6.h3 e5 7.d5 a5 8.Bg5 Na6 9.
Nd2 Qe8 10.Be2 Nd7 11.Nb3 b6 12.O-O Ndc5 13.Nxc5 Nxc5 14.Qd2 f5 15.exf5 
gxf5 16.f4 Qg6 17.fxe5 f4 18.Rxf4 Rxf4 19.Qxf4 Bxe5 20.Qh4 Bxh3 21.Rf1 h6 
22.Qxh6 Bf5 23.Qh4 Qh7 24.Bh5 Nd7 25.Nb5 Nf8 26.Bf6 Bg6 27.Bxg6 Qxh4 28.
Bf7+ Kxf7 29.Bxh4+ Kg8 30.Bf6 Bxf6 31.Rxf6 Rc8 32.b3 Kg7 33.Rf5 Nd7 34.g4 
Kg6 35.Kg2 Nc5 36.Kg3 a4 37.Rf3 axb3 38.axb3 Ne4+ 39.Kf4 Ng5 40.Re3 Rf8+ 
41.Kg3 Rf7 42.Nd4 Rf1 43.Ne6 Rg1+ 44.Kf2 Rxg4 45.Nxc7 Kf5 46.Ke2 Ne4 47.
Kd3 Nf2+ 48.Kc2 Ne4 49.Kb2 Rg7 50.Nb5 Rh7 51.Ka3 Kf4 52.Re1 Rh3 53.Rf1+ 
Ke5 54.Re1 Kf4 55.Nd4 Rd3 56.Ne6+ Kf5 57.Rf1+ Ke5 58.Re1 Kf5 59.Ng7+ Kf4 
60.Ne6+ Kf5 1/2-1/2'
        ],
        [
            'event' => 'Gibraltar Masters 2018',
            'site' => 'Caleta ENG',
            'date' => '2018-01-29',
            'round' => '7.6',
            'white' => 'Harikrishna, Pendyala',
            'black' => 'Oparin, Grigoriy',
            'result' => '0-1',
            'white_elo' => '2745',
            'black_elo' => '2607',
            'eco' => 'B90',
            'event_date' => '2018-01-23',
            'pgn' => '1.e4 c5 2.Nf3 d6 3.d4 cxd4 4.Nxd4 Nf6 5.Nc3 a6 6.a3 Nc6 7.Bc4 e6 8.Ba2 Be7
9.O-O O-O 10.Kh1 Qc7 11.Bg5 h6 12.Be3 b5 13.Qf3 Rb8 14.Bb3 Na5 15.Qg3 Kh8 
16.f4 Nxb3 17.Nxb3 b4 18.axb4 Rxb4 19.Bd4 Bb7 20.Rad1 a5 21.e5 dxe5 22.
Bxe5 Qb6 23.Bd4 Qc7 24.Be5 Qb6 25.Rd7 Bd8 26.Rfd1 Bc6 27.R7d6 Be7 28.R6d3 
Rg8 29.Bd4 Qc7 30.Be5 Qb6 31.Bd4 Qa6 32.Qh4 Kh7 33.Qh3 a4 34.Nd2 Rxb2 35.
Nf3 Bxf3 36.Qxf3 Rxc2 37.Bxf6 Bxf6 38.Qe4+ Kh8 39.Rd6 Qxd6 40.Rxd6 Rxc3 
41.g3 a3 42.Ra6 Rgc8 43.f5 Rc1+ 44.Kg2 R1c2+ 45.Kh3 a2 46.fxe6 fxe6 0-1'
        ],
        [
            'event' => 'Gibraltar Masters 2018',
            'site' => 'Caleta ENG',
            'date' => '2018-01-29',
            'round' => '7.49',
            'white' => 'Christiansen, Johan-Sebastian',
            'black' => 'Lazarne Vajda, Szidonia',
            'result' => '1/2-1/2',
            'white_elo' => '2492',
            'black_elo' => '2362',
            'eco' => 'C55',
            'event_date' => '2018-01-23',
            'pgn' => '1.e4 e5 2.Nf3 Nc6 3.Bc4 Bc5 4.O-O Nf6 5.d4 Bxd4 6.Nxd4 Nxd4 7.Bg5 d6 8.f4 
Qe7 9.Bxf6 gxf6 10.f5 d5 11.Bxd5 Qc5 12.Rf2 c6 13.Bb3 Ke7 14.c3 Nxb3 15.
axb3 Rd8 16.Qe1 b5 17.b4 Qb6 18.Nd2 a5 19.Nb3 a4 20.Nc5 Bb7 21.Rd2 Rxd2 
22.Qxd2 Rd8 23.Qe2 Bc8 24.Rd1 Rxd1+ 25.Qxd1 Qa7 26.Qc1 Qc7 27.Kf2 Qd8 28.
g3 Qg8 29.Qd1 Qg5 30.h3 Qh6 31.h4 Qg7 32.Qh5 Kd6 33.Kg2 Ke7 34.Kh3 Kf8 35.
Qe2 Qh6 36.Nd3 Bd7 37.Qf2 Ke8 38.Qa7 Qd2 39.Nc5 h5 40.Qb8+ Ke7 41.Nb7 
Bxf5+ 42.exf5 Qd7 43.Qa7 Qxf5+ 44.Kg2 Qe4+ 45.Kf2 Qc2+ 46.Ke3 Qc1+ 47.Kf3 
Qd1+ 48.Kg2 Qd5+ 49.Kh2 Qd2+ 50.Kh1 Qd5+ 51.Kg1 Qd1+ 52.Kf2 Qd2+ 53.Kf3 
Qd1+ 54.Kg2 Qd5+ 55.Kh2 Qd2+ 56.Kh1 Qd5+ 1/2-1/2'
        ],
        [
            'event' => 'Vajda Arpad Memorial 2018',
            'site' => 'Budapest HUN',
            'date' => '2018-01-29',
            'round' => '1.4',
            'white' => 'Beliavsky, Alexander G',
            'black' => 'Kantor, Gergely',
            'result' => '1/2-1/2',
            'white_elo' => '2536',
            'black_elo' => '2518',
            'eco' => 'D47',
            'event_date' => '2018-01-29',
            'pgn' => '1.d4 Nf6 2.c4 e6 3.Nf3 d5 4.Nc3 c6 5.e3 Nbd7 6.Bd3 dxc4 7.Bxc4 b5 8.Bd3 
Bd6 9.O-O O-O 10.Bd2 Bb7 11.Rc1 Rc8 12.a3 a5 13.Ne4 Nxe4 14.Bxe4 b4 15.
axb4 axb4 16.Qa4 Qb6 17.Rfd1 Nf6 18.Bd3 c5 19.dxc5 Rxc5 20.Rxc5 Qxc5 21.
Qb5 Qxb5 22.Bxb5 Rc8 23.Rc1 Rxc1+ 24.Bxc1 Ne4 25.Nd2 Nxd2 26.Bxd2 Be5 27.
Bxb4 Bxb2 28.f3 Bd5 29.Kf2 f5 30.Be8 Be5 1/2-1/2'
        ],
        [
            'event' => 'Gibraltar Masters 2018',
            'site' => 'Caleta ENG',
            'date' => '2018-01-29',
            'round' => '7.35',
            'white' => 'Georgiev, Kiril',
            'black' => 'Raja, H',
            'result' => '1-0',
            'white_elo' => '2623',
            'black_elo' => '2427',
            'eco' => 'E17',
            'event_date' => '2018-01-23',
            'pgn' => '1.d4 Nf6 2.Nf3 e6 3.c4 b6 4.g3 Bb7 5.Bg2 Be7 6.O-O O-O 7.Bf4 d5 8.Nc3 dxc4
9.Qa4 Nd5 10.Qxc4 Nxf4 11.gxf4 Nd7 12.Rfd1 Qc8 13.d5 Nc5 14.b4 exd5 15.
Nxd5 Bxd5 16.Rxd5 Na6 17.Ne5 Bf6 18.Rad1 c6 19.Nxc6 Nxb4 20.Qxb4 Qxc6 21.
Rd6 Qc2 22.Bxa8 Rxa8 23.Qd2 Qg6+ 24.Kf1 Re8 25.Qe3 Rf8 26.h3 Qc2 27.R1d2 
Qa4 28.Kg2 Re8 29.Qf3 1-0'
        ],
        [
            'event' => 'Gibraltar Masters 2018',
            'site' => 'Caleta ENG',
            'date' => '2018-01-29',
            'round' => '7.4',
            'white' => 'Aronian, Levon',
            'black' => 'Short, Nigel D',
            'result' => '1-0',
            'white_elo' => '2797',
            'black_elo' => '2681',
            'eco' => 'A21',
            'event_date' => '2018-01-23',
            'pgn' => '1.c4 e5 2.Nc3 d6 3.Nf3 f5 4.g3 Nc6 5.d4 e4 6.d5 Ne5 7.Nxe5 dxe5 8.g4 Bc5 
9.Qb3 Nf6 10.Qb5+ Nd7 11.h4 a6 12.Qb3 e3 13.Bxe3 Bxe3 14.fxe3 fxg4 15.Ne4 
Nf6 16.Bg2 O-O 17.c5 Kh8 18.O-O-O Bf5 19.Ng3 Bg6 20.h5 Nxh5 21.Nxh5 Rf2 
22.Bf1 Qf8 23.Ng3 Qxc5+ 24.Qc3 Qe7 25.e4 Qg5+ 26.Kb1 Qf4 27.Ka1 Rf8 28.Rg1
Rf7 29.e3 Qg5 30.Bc4 Rd7 31.Qb4 b5 32.Nf5 h5 33.Qe1 Rf3 34.Be2 Rh3 35.Bf1 
Bxf5 36.Bxh3 Bxe4 37.Bg2 Bxg2 38.Rxg2 h4 39.Qb4 1-0'
        ],
        [
            'event' => 'Gibraltar Masters 2018',
            'site' => 'Caleta ENG',
            'date' => '2018-01-29',
            'round' => '7.40',
            'white' => 'Peralta, Fernando',
            'black' => 'Melia, Salome',
            'result' => '1-0',
            'white_elo' => '2559',
            'black_elo' => '2404',
            'eco' => 'E48',
            'event_date' => '2018-01-23',
            'pgn' => '1.d4 Nf6 2.c4 e6 3.Nc3 Bb4 4.e3 O-O 5.Bd3 d5 6.cxd5 exd5 7.Ne2 Re8 8.O-O 
Bd6 9.Nf4 c6 10.f3 b6 11.Kh1 Qc7 12.g4 Bxf4 13.exf4 Ba6 14.f5 Bxd3 15.Qxd3
Nbd7 16.Ne2 c5 17.Bf4 Qb7 18.Ng3 c4 19.Qd2 Nf8 20.Be5 Qc6 21.Rae1 Rac8 22.
Rg1 N6d7 23.Bxg7 Kxg7 24.Nh5+ Kh8 25.Qg5 Ng6 26.fxg6 fxg6 27.Qh6 Rg8 28.
Re7 Nf8 29.Qf4 1-0'
        ],
        [
            'event' => 'Gibraltar Masters 2018',
            'site' => 'Caleta ENG',
            'date' => '2018-01-29',
            'round' => '7.10',
            'white' => 'Rapport, Richard',
            'black' => 'Huzman, Alexander',
            'result' => '1-0',
            'white_elo' => '2700',
            'black_elo' => '2561',
            'eco' => 'E05',
            'event_date' => '2018-01-23',
            'pgn' => '1.d4 Nf6 2.c4 e6 3.g3 d5 4.Bg2 Be7 5.Nf3 O-O 6.O-O dxc4 7.Qc2 b6 8.Bg5 Nd5
9.Bxe7 Qxe7 10.Nbd2 Ba6 11.Nxc4 c5 12.Rfc1 Nd7 13.Qa4 Bb7 14.Qa3 N5f6 15.
dxc5 Nxc5 16.Na5 Bd5 17.Ne5 Bxg2 18.Kxg2 Nfd7 19.Nac6 Qe8 20.b4 f6 21.Nc4 
Nb7 22.Rd1 b5 23.Ne3 Nb6 24.Rac1 a6 25.Na5 Nxa5 26.bxa5 Nd7 27.Qb3 Rf7 28.
Rd6 Nf8 29.Rcc6 Rd7 30.Nc2 Rxd6 31.Rxd6 Qb8 32.Rb6 Qe5 33.Qf3 Rc8 34.Nb4 
Rc4 35.Nc6 Qc5 36.Rxa6 Rc3 37.Ne7+ Kf7 38.Rc6 Rxf3 39.Rxc5 Ra3 40.Nc6 Rxa2
41.Rxb5 f5 42.Rb8 g5 43.Ra8 Rc2 44.Nd8+ Ke7 45.a6 Kd7 46.a7 Ra2 47.Nf7 1-0'
        ],
        [
            'event' => 'Gibraltar Masters 2018',
            'site' => 'Caleta ENG',
            'date' => '2018-01-29',
            'round' => '7.39',
            'white' => 'Kozak, Adam',
            'black' => 'Kosteniuk, Alexandra',
            'result' => '1/2-1/2',
            'white_elo' => '2418',
            'black_elo' => '2561',
            'eco' => 'E18',
            'event_date' => '2018-01-23',
            'pgn' => '1.d4 Nf6 2.c4 e6 3.Nf3 b6 4.g3 Be7 5.Nc3 Bb7 6.Bg2 O-O 7.O-O Ne4 8.Nxe4 
Bxe4 9.Nh4 Bxg2 10.Nxg2 d6 11.b3 Nd7 12.Bb2 a5 13.Qc2 Qb8 14.a4 Qb7 15.
Rad1 d5 16.cxd5 exd5 17.Ne3 Rfe8 18.Rc1 Rac8 19.Qc6 Qxc6 20.Rxc6 Nb8 21.
Rc2 c6 22.h4 Na6 23.Rfc1 Nb4 24.Rd2 g6 25.Ba3 Nd3 26.Rxd3 Bxa3 27.Rc2 Red8
28.h5 Kg7 29.hxg6 hxg6 30.Kg2 f5 31.Kf3 Rd6 32.g4 Kf7 33.gxf5 gxf5 34.Ng2 
Rh6 35.e3 1/2-1/2'
        ],
        [
            'event' => 'Gibraltar Masters 2018',
            'site' => 'Caleta ENG',
            'date' => '2018-01-29',
            'round' => '7.50',
            'white' => 'Mohammad Nubairshah, Shaikh',
            'black' => 'Xu, Yi',
            'result' => '1/2-1/2',
            'white_elo' => '2380',
            'black_elo' => '2482',
            'eco' => 'E46',
            'event_date' => '2018-01-23',
            'pgn' => '1.c4 Nf6 2.Nc3 e6 3.d4 Bb4 4.e3 O-O 5.Ne2 Re8 6.a3 Bf8 7.d5 c6 8.g3 b5 9.
dxe6 bxc4 10.exf7+ Kxf7 11.b3 cxb3 12.Bg2 Na6 13.Qxb3+ d5 14.O-O Nc5 15.
Qc2 Kg8 16.Rb1 Bg4 17.h3 Bh5 18.Nf4 Bf7 19.Na4 Qa5 20.Nxc5 Qxc5 21.Qxc5 
Bxc5 22.Bb2 Bd6 23.Bxf6 gxf6 24.Rfc1 Rac8 25.Rb7 Bxa3 26.Rc3 Bd6 27.Rxa7 
Be5 28.Rc1 Bxf4 29.gxf4 c5 30.Rd7 d4 31.exd4 cxd4 32.Rxc8 Rxc8 33.Rxd4 Rc4
34.Rd8+ Kg7 35.Rd7 Kg8 36.Rd8+ Kg7 37.Rd7 Kg8 38.f5 Rf4 39.Bd5 Bxd5 40.
Rxd5 Kg7 41.Kg2 Kh6 42.Kg3 Kg5 43.Rd7 h6 44.h4+ Rxh4 45.Rg7+ Kh5 46.Rf7 
Kg5 47.Rg7+ Kh5 48.Kf3 Rg4 49.Rf7 Kg5 50.Rg7+ Kh5 51.Rh7 Kg5 52.Rg7+ Kh5 
53.Rxg4 1/2-1/2'
        ],
    ];

    public function load(ObjectManager $manager)
    {
        foreach (self::$gamesArray as $game)
        {
            $newGame = new Game();
            $newGame->setEvent($game['event']);
            $newGame->setSite($game['site']);
            $newGame->setDate(new \DateTime($game['date']));
            $newGame->setRound($game['round']);
            $newGame->setWhite($game['white']);
            $newGame->setBlack($game['black']);
            $newGame->setResult($game['result']);
            $newGame->setWhiteElo($game['white_elo']);
            $newGame->setBlackElo($game['black_elo']);
            $newGame->setEco($game['eco']);
            $newGame->setEventDate(new \DateTime($game['event_date']));
            $newGame->setPgn($game['pgn']);

            $manager->persist($newGame);
        }

        $manager->flush();
    }
}

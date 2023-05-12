<?php

require 'board.php';

class Game {

    function __construct() {
        $this->ships = [
            new ship('[C]', 5), 
            new Ship('[B]', 4), 
            new Ship('[S]', 3), 
            new Ship('[F]', 3), 
            new Ship('[D]', 2)
        ];
    }

    function random_position($board) {
        $x = rand(0, $board::COLUMNS -1);
        $y = rand(0, $board::ROWS -1);
        $position = [$x, $y];

        return $position;
    }

    function place_ships($board) {
        
        $ships_to_place = count($this->ships);
        $position = $this->random_position($board);
        
        $ship = 0;
        
            do {
                $a_ship = $this->ships[$board->ship_placed];
                $valid = $board->is_position_valid($position, $a_ship);
                if ($valid) {
                    $board->place_ship($position, $a_ship);
                    $ship++;
                } else { 
                    $new_position = $this->random_position($board);
                    $position = $new_position;
                }

            } while($ship!=5);
    }
}

$game = new Game();
$board = new Board();


$game->place_ships($board);

$board->render_board();
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

    function random_place($board) {
        $orientation = rand(0, 1);
        $orientations = ['vertical', 'horizonal'];
        $x = rand(0, $board::COLUMNS -1);
        $y = rand(0, $board::ROWS -1);
        $position = [$x, $y];

        return [$position, $orientations[$orientation]];
    }

    function toggle_orientation($ship) : void {
        $orientations = ['vertical', 'horizontal'];
        if ($ship->orientation == $orientations[0]) {$ship->orientation = $orientations[1];} else {
            $ship->orientation = $orientations[0];
        }
    }

    function place_ships($board) {
        
        $ships_to_place = count($this->ships) - 1;
        $ship = 0;
        $ships_placed = 0;
        $random = $this->random_place($board);
        $a_ship = $this->ships[$ship];
        $a_ship->orientation = $random[1];
        $ship_not_placed = true;
        
        do {

            if ($board->is_position_valid($random[0], $a_ship)) {
                $board->place_ship($random[0], $a_ship);
                $ship++;
                $ships_placed++;
                $ship_not_placed = false;
                
            } else {
                $ship_not_placed = true;
                $this->toggle_orientation($a_ship);
                $board->place_ship($random[0], $a_ship);
                if (!$board->is_position_valid($random[0], $a_ship)) {
                    $new_random = $this->random_place($board);
                    $random = $new_random;
                }
            }
        } while($ship_not_placed && ($ships_placed !== $ships_to_place));
    }
}

$game = new Game();
$board = new Board();


$game->place_ships($board);
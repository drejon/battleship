<?php
    
    require 'board.php';

    class Game {

        function __construct() {
            $this->ships = [new Ship('[C]', 5), new Ship('[B]', 4), new Ship('[S]', 3), new Ship('[F]', 3), new Ship('[D]', 2)];
        }

        function generate_random_position() {
            
            $orientations = ['v', 'h'];
            
            $orientation = rand(0, 1);
            $position = [rand(0, 7), rand(0, 7)];
            return [$position, $orientations[$orientation]];
        }

        function place_ships(Board $board) {
            $i = 0;
            $number_of_ships = count($this->ships);
            $placed_ships = 0;

            for ($ship=0; $ship <= $number_of_ships; $ship++) { 
                $is_placed = true;
                echo $ship;
                while ($is_placed) {
                    $random_position = $this->generate_random_position();
                    $is_placed = $board->place_ship($random_position[0], $random_position[1], $this->ships[$ship]);
                }
                $is_placed = true;
            }
            
            $board->render_board();
            return true;
        }
    }
    $board = new Board();
    $game = new Game($board);
    $game->place_ships($board);
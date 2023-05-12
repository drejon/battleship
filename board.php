<?php

require 'ship.php';


class Board {

    const COLUMNS = 7;
    const ROWS = self::COLUMNS - 2;
    public $tiles = [];

    function __construct() {
        for ($column=0; $column < self::COLUMNS; $column++) {
            $this->tiles[$column] = [];
            for ($row=0; $row < self::ROWS; $row++) {
                $this->tiles[$column][$row] = new Ship('[ ]', 0);
                $this->tiles[$column][$row]->position = [$column, $row];
            }
        }
    }

    function render_board() {
        print('------------------------------------'."\n");
        for ($column=0; $column < self::ROWS; $column++) {
            for ($row=0; $row < self::COLUMNS; $row++) {
                print(" ".$this->tiles[$row][$column]->name);
            }
            print("\n");
        }
    }

    function get_tile($position) {
        return $this->tiles[$position[0]][$position[1]]->name;
    }

    function set_tile($position, $ship) {
        $ship->position = $position;
        return $this->tiles[$position[0]][$position[1]] = $ship;
    }

    function is_position_valid($position, $ship) {
        // Look right
        if ($position[0] + $ship->length <= self::COLUMNS && $ship->orientation == 'horizontal') {

            $tiles_avaliable = 0;
            for ($column = $position[0]; $column <= ($position[0] + $ship->length - 1); $column++) { 
                $tile_content = $this->get_tile([$column, $position[1]]);
                if ($tile_content == '[ ]') {$tiles_avaliable++;}
            }
        
            if ($tiles_avaliable == $ship->length) {return true;}
        } else return false;
        // Look Down
        if ($position[1] + $ship->length <= self::ROWS && $ship->orientation == 'vertical') {

            $tiles_avaliable = 0;
            for ($row = $position[1]; $row <= ($position[1] + $ship->length - 1); $row++) { 
                $tile_content = $this->get_tile([$position[0], $row]);
                if ($tile_content == '[ ]') {$tiles_avaliable++;}
            }

            if ($tiles_avaliable == $ship->length) {return true;}

        } else return false;
    }

    public function place_ship($position, $ship) {

        if ($this->is_position_valid($position, $ship)) {
            if ($ship->orientation == 'horizontal') {
                for ($column = $position[0]; $column <= ($position[0] + $ship->length - 1); $column++) { 
                    $this->set_tile([$column, $position[1]], $ship);
                }
                $this->render_board();
            }

            if ($ship->orientation == 'vertical') {
                for ($row = $position[1]; $row <= ($position[0] + $ship->length - 1); $row++) { 
                    $this->set_tile([$position[0], $row], $ship);
                }
                $this->render_board();
            }
        }
    }
}

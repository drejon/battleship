<?php
    
    require 'ship.php';

    
    class Board {

        const SIZE = 7;
        public $tiles = [];

        function __construct() {
            for ($column=0; $column < self::SIZE; $column++) { 
                $this->tiles[$column] = [];
                for ($row=0; $row < self::SIZE; $row++) { 
                    $this->tiles[$column][$row] = new Ship('[ ]', 0);
                }
            }

            //$this->render_board();
        }

        function render_board() {
            print('------------------------------------'."\n");
            for ($column=0; $column < self::SIZE; $column++) { 
                for ($row=0; $row < self::SIZE; $row++) { 
                    print(" ".$this->tiles[$row][$column]->name);
                }
                print("\n");
            }
        }

        function is_ship_allready($position, $orientation, Ship $ship) : bool {
            $flag = false;

            if (($position[0] + $ship->length) > self::SIZE) {return false;}
            if (($position[1] + $ship->length) > self::SIZE) {return false;}


            if ($orientation == 'v') {
                for ($i=$position[1]; $i < $position[1] + $ship->length; $i++) { 
                    if ($this->tiles[$position[0]][$i]->name !== '[ ]') {$flag = True;}
                }
            }

            if ($orientation == 'h') {
                for ($i=$position[0]; $i < $position[0] + $ship->length; $i++) { 
                    if ($this->tiles[$i][$position[1]]->name !== '[ ]') {$flag = True;}
                }
            }

            return $flag;
        }

        function place_ship($position, $orientation, Ship $ship) {
            
            if ($this->is_ship_allready($position, $orientation, $ship)) {return false;}
            
            if ($orientation == 'v') {
                for ($i=$position[1]; $i < $position[1] + $ship->length; $i++) { 
                    if (($position[1] + $ship->length) > self::SIZE) {return false;}
                    $this->tiles[$position[0]][$i] = $ship;
                    return true;
                }
            } elseif ($orientation == 'h') {
                for ($i=$position[0]; $i < $position[0] + $ship->length; $i++) { 
                    if (($position[0] + $ship->length) > self::SIZE) {return false;}
                    $this->tiles[$i][$position[1]] = $ship;
                    return true;
                }
            }
        }
    }

    $board = new Board();
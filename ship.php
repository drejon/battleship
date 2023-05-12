<?php

    class Ship {

        public $destroyed = false;
        public $position;
        public $orientation;
        
        function __construct($name, $length) {
            $this->length = $length;
            $this->name = $name;
        }
    }

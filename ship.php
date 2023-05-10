<?php

    class Ship {

        public $destroyed = false;

        function __construct($name, $length) {
            $this->length = $length;
            $this->name = $name;
        }

    }

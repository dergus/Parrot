<?php
    namespace dergus\fw\helpers;

    /**
    *
    */
    class Html
    {

        public static function encode($str)
        {
            return htmlspecialchars($str);
        }

    }
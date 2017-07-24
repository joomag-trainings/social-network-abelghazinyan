<?php
    /**
     * Created by PhpStorm.
     * User: abelghazinyan
     * Date: 7/23/17
     * Time: 10:45 PM
     */

    namespace Helper;

    class Debug
    {
       public static function consoleLog( $data )
       {
            $output = $data;
            if ( is_array( $output ) )
                $output = implode( ',', $output);

            echo "<script>console.log( 'Debug Objects: " . $output . "' );</script>";
        }
    }
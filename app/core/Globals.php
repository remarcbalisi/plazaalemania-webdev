<?php

class Globals{

    protected static $root_dir = "plazaalemaniawebdev";
    protected static $http = "http://";
    protected static $host = "localhost";
    public static $title_page = "Plaza Alemania";

    public static function baseUrl(){
        $root_dir = "plazaalemaniawebdev";
        $http = "http://";
        $host = "localhost";
        $base_url = $http . $host . "/" . $root_dir;
        return $base_url;
    }

}

?>

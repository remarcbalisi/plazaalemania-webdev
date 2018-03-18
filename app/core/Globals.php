<?php

class Globals{

    protected static $root_dir = "";
    protected static $http = "http://";
    protected static $host = "plazaalemania.epizy.com";
    public static $title_page = "Plaza Alemania";

    public static function baseUrl(){
        $root_dir = "";
        $http = "http://";
        $host = "plazaalemania.epizy.com";
        $base_url = $http . $host . "" . $root_dir;
        return $base_url;
    }

}

?>

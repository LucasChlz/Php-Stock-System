<?php

    class Stock
    {

        public static function loadPage() {
            if(isset($_GET['url'])) {
                $url = explode('/',$_GET['url']);
                if(file_exists('pages/includes/'.$url[0].'.php')) {
                    include('pages/includes/'.$url[0].'.php');
                }else {
                    header('Location: '.MAIN_PATH);
                    die();
                }
            }
        }

        
    }

?>
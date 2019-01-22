<?php
require 'constants.php';
require 'NewsScrapper.php';
require 'NoticiasAoMinuto.php';
require 'JornalNoticias.php';
require 'SicNoticias.php';

if($argc >= 2) {
    handleCommand();
} else {
    echo "Fui mal chamado";
}

function handleCommand() {
    global $argv, $argc;

    $command = $argv[1];

    switch ($command) {
        case INIT:
            echo 'here';
            break;
        case GETNEWSBYURL:
            getNewsByUrl($argv[2]);
            break;
        default:
            echo 'there';
    }

}

function getNewsByUrl($pNewsUrl) {
    if(strpos($pNewsUrl, 'noticiasaominuto')) {
        $a = new NoticiasAoMinuto($pNewsUrl);
        $n = $a->getNewsContent();
        var_dump($n);
    }

    if(strpos($pNewsUrl, 'jn')){
        $a = new JornalNoticias($pNewsUrl);
        $n = $a->getNewsContent();
        var_dump($n);
    }

    if(strpos($pNewsUrl, 'sicnoticias')){
        $a = new SicNoticias($pNewsUrl);
        $n = $a->getNewsContent();
        var_dump($n);
    }
}

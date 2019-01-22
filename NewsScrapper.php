<?php

abstract class NewsScrapper {

    private $mNewsUrl;

    public function __construct($pNewsUrl)
    {
        if(filter_var($pNewsUrl, FILTER_VALIDATE_URL)) {
            $this->mNewsUrl = $pNewsUrl;
        } else {
            echo "Invalid URL";
        }
    }

    public function getNewsHtml() {
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $this->mNewsUrl);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        $html = curl_exec($ch);
        curl_close($ch);

        return $html;
    }

    public abstract function getNewsContent();



}
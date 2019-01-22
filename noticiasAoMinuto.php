<?php

// Created by: Flávio Monteiro

class NoticiasAoMinuto extends NewsScrapper
{


    public function getNewsContent()
    {
        $html = $this->getNewsHtml();

        # Create a DOM parser object
        $dom = new DOMDocument();

        # The @ before the method call suppresses any warnings that
        # loadHTML might throw because of invalid HTML in the page.
        @$dom->loadHTML($html);

        $xpath = new DOMXpath($dom);
        $elements = $xpath->query("//div[contains(@class,'news-container')]");
        $descricaoDetalhadaQuery = $xpath->query("//div[contains(@class,'news-main-text')]");
        $divImg = $xpath->query("//div[contains(@class,'news-main-image')]");

        //var_dump($divImg->item(0)->getElementsByTagName('img')->item(1)->getAttribute('src'));

        $element = $elements->item(0);
        $titulo = $element->getElementsByTagName('h1')->item(0)->nodeValue;

        if ($divImg->item(0)->getElementsByTagName('img')->item(1) != null) {
            $img = $divImg->item(0)->getElementsByTagName('img')->item(1)->getAttribute('src');

        } else {
            $img = "Sem Imagem" . PHP_EOL;

        }
        var_dump($img);
//$descricaoPrincipal = $element->getElementsByTagName('h2')->item(0)->nodeValue;
        if ($descricaoDetalhadaQuery->length != 0) {
            $descricaoDetalhada = $descricaoDetalhadaQuery->item(0)->getElementsByTagName('p');
            $corpo = "";
            foreach ($descricaoDetalhada as $cenas) {

                $corpo .= $cenas->nodeValue;

            }
        }

        $mRet = array(

            'titulo' => $titulo,
            'imagem' => $img,
            'texto' => $corpo
        );
        return $mRet;
    }
}


<?php

class JornalNoticias extends NewsScrapper
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
        $elements = $xpath->query("//article[contains(@class,'t-article-1')]");

        $element = $elements->item(0);

        #retirar o titulo, o texto e a imagem

        #titulo
        $titulo = $element->getElementsByTagName('h1')->item(0)->nodeValue;

        #imagem
        $img = $element->getElementsByTagName('img')->item(0);
        if (!($img == null)) {
            $imgSrc = $img->getAttribute("src");
        }

        #texto
        $divs = $element->getElementsByTagName('div');

        foreach ($divs as $div) {

            if ($div->getAttribute('class') == 't-article-content') {

                $corpo = $div->nodeValue;

            }
        }

        $mRet = array(

            'titulo' => $titulo,
            'imagem' => $imgSrc,
            'texto' => $corpo
        );

        return $mRet;
    }
}
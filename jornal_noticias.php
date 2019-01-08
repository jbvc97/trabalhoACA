<?php


class jn
{

    public function getNoticias($urlNoticia)
    {

        $ch = curl_init();
        $timeout = 5;
        curl_setopt($ch, CURLOPT_URL, $urlNoticia);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        $html = curl_exec($ch);
        curl_close($ch);

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
            $img->getAttribute("src");
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
            'imagem' => $img,
            'texto' => $corpo
        );

        return $mRet;
    }
}
/*
 $jnResult = new jn();

$result = $jnResult->getNoticias("https://www.jn.pt/nacional/videos/interior/meio-dia-em-60-segundos-tribunal-absolve-duarte-lima-do-crime-de-burla-10409601.html");

var_dump($result);
*/
#var_dump($img); consulta rapida




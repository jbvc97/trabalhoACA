<?php


# Use the Curl extension to query Google and get back a page of results
class sic
{

    public function getNoticias($url){

$ch = curl_init();
$timeout = 5;
curl_setopt($ch, CURLOPT_URL, $url);
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
$elements = $xpath->query("//article");
$descricaoDetalhadaQuery = $xpath->query("//div[contains(@class,'article-content')]");
//sizearticle col-md-9 col-sm-12 pull-right
$element = $elements->item(0);
$titulo = $element->getElementsByTagName('h1')->item(0)->nodeValue;

if ($element->getElementsByTagName('link')->item(0)!=null)
{

$img = $element->getElementsByTagName('link')->item(0)->getAttribute("href");

}

else if($element->getElementsByTagName('img')->item(0)!=null){

    $img = $element->getElementsByTagName('img')->item(0)->getAttribute("src");

}else{
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
            'texto'  => $corpo
        );
        return $mRet;
    }
}

$sicResult = new sic();

$result = $sicResult->getNoticias("https://sicnoticias.sapo.pt/mundo/2018-03-14-Cientistas-alertam-para-riscos-eticos-de-uso-de-inteligencia-artificial-na-medicina");

var_dump($result);
<?php


# Use the Curl extension to query Google and get back a page of results
$url = "https://www.rtp.pt/noticias/mundo/cidade-chinesa-inicia-ano-com-frota-de-taxis-composta-por-carros-eletricos_n1121394";


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
$descricaoDetalhadaQuery = $xpath->query("//div[contains(@class,'sizearticle')]");
//sizearticle col-md-9 col-sm-12 pull-right
$element = $elements->item(0);
$titulo = $element->getElementsByTagName('h1')->item(0)->nodeValue;

if($element->getElementsByTagName('link')->item(0)!=null){

    $img = $element->getElementsByTagName('link')->item(0)->getAttribute("href");
    file_put_contents('file.txt', $img . "\n", FILE_APPEND);

}else{
    $img= "Sem Imagem".PHP_EOL;
    file_put_contents('file.txt', $img . "\n", FILE_APPEND);

}

$descricaoPrincipal = $element->getElementsByTagName('h2')->item(0)->nodeValue;
file_put_contents('file.txt', $descricaoPrincipal . "\n", FILE_APPEND);

if($descricaoDetalhadaQuery->length!=0){
    $descricaoDetalhada = $descricaoDetalhadaQuery->item(0)->nodeValue;
    file_put_contents('file.txt', $descricaoDetalhada, FILE_APPEND);
}




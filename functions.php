<?php

function dbConn(){
    global $pdo;
    $pdo = new PDO('mysql:dbname=csvphp;host=localhost', 'root', '');
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_OBJ);
    $pdo->exec("SET CHARACTER SET utf8");
}

function arrayToJson($array){
    $fp = fopen('results.json', 'w');
    fwrite($fp, json_encode($array, JSON_UNESCAPED_UNICODE));
    fclose($fp);
}

function jsonToCSV($jfilename, $cfilename)
{
    if (($json = file_get_contents($jfilename)) == false)
        die('Error reading json file...');
    $data = json_decode($json, true);
    $fp = fopen($cfilename, 'w');
    $header = false;
    foreach ($data as $row)
    {
        if (empty($header))
        {
            $header = array_keys($row);
            fputcsv($fp, $header);
            $header = array_flip($header);
        }
        fputcsv($fp, array_merge($header, $row));
    }
    fclose($fp);
    return;
}

function generateProductCollection($length){  
    $string = '';
    $voyelles = array("a","e","i","o","u");
    $consonnes = array(
        'b', 'c', 'd', 'f', 'g', 'h', 'j', 'k', 'l', 'm', 
        'n', 'p', 'r', 's', 't', 'v', 'w', 'x', 'y', 'z'
    );  
    // Seed it
    srand((double) microtime() * 1000000);
    $max = $length/2;
    for ($i = 1; $i <= $max; $i++)
    {
        $string .= $consonnes[rand(0,19)];
        $string .= $voyelles[rand(0,4)];
    }
    return ucfirst($string);
}

function generateType($type){
    if ($type == "simple"){
        $pType = "simple";
        return $pType;
    }
    elseif ($type == "simplevariable"){
        $listTypes = array(
            "simple",
            "variable"
        );
        $key = array_rand($listTypes);
        $pType = $listTypes[$key];
        return $pType;
    }
    return NULL;
}

function generateSku(){
    $sku = 'PDT' . rand(1000, 9999);
    return $sku;
}

function generateVisibility($visibility){
    if ($visibility == "visible"){
        $pVisibility = "visible";
        return $pVisibility;
    }
    elseif ($visibility == "hidden"){
        $pVisibility = "hidden";
        return $pVisibility;
    }
    elseif ($visibility == "random"){
        $listVisibilities = array(
            "visible",
            "hidden"
        );
        $key = array_rand($listVisibilities);
        $pVisibility = $listVisibilities[$key];
        return $pVisibility;
    }
    return NULL;
}

function generateShortDescription(){
    $pShortDescription = file_get_contents('http://loripsum.net/api/1/short/plaintext');
    return $pShortDescription;
}

function generateDescription(){
    $pDescription = file_get_contents('http://loripsum.net/api/1/short/plaintext');
    return $pDescription;
}

function generateStock($stock){
    if ($stock == "enstock"){
        $pStock = "1";
        return $pStock;
    }
    elseif ($stock == "pasenstock"){
        $pStock = "0";
        return $pStock;
    }
    elseif ($stock == "random"){
        $listStocks = array(
            1,
            0
        );
        $key = array_rand($listStocks);
        $pStock = $listStocks[$key];
        return $pStock;
    }
    return NULL;
}

function generateWeight(){
    $pWeight = mt_rand(10, 300);
    return strval($pWeight / 100);
}

function generateDimensions($dimensions){
    if($dimensions == "petites"){
        $pDimensions = mt_rand(10, 100);
        return strval(($pDimensions) / 10);
    }
    elseif ($dimensions == "moyennes"){
        $pDimensions = mt_rand(100, 250);
        return strval(($pDimensions) / 10);
    }
    elseif ($dimensions == "grandes"){
        $pDimensions = mt_rand(350, 650);
        return strval(($pDimensions) / 10);
    }
    elseif ($dimensions == "random"){
        $pDimensions = mt_rand(10, 650);
        return strval(($pDimensions) / 10);
    }
    return NULL;
}

function generateAllowedComments($comments){
    if($comments == "autorise"){
        $pComments = 0;
        return strval($pComments);
    }
    elseif ($comments == "nonautorise"){
        $pComments = 0;
        return strval($pComments);
    }
    elseif ($comments == "random"){
        $listComments = array(
            0,
            1
        );
        $key = array_rand($listComments);
        $pComments = $listComments[$key];
        return strval($pComments);
    }
    return NULL;
}

function generatePrice($minPrice, $maxPrice){
    $pPrice = floor(rand($minPrice * 10, $maxPrice * 10) / 10);
    $decimalsArray = array(
        NULL,
        '.25',
        '.50',
        '.75',
        '.99',
        NULL
    );
    $key = array_rand($decimalsArray);
    $pDecimal = $decimalsArray[$key];
    return strval($pPrice . $pDecimal);
}

function generateNames($theme){
    /** Name - Category - Subcategory */
    $listNames = array();
    if($theme == "alimentation"){
        $listNames = array(
            array("Sirop de grenadine", "Sirops"),
            array("Sirop de menthe", "Sirops"),
            array("Sirop de myrtille", "Sirops"),
            array("Soda artisanal aux agrumes", "Boissons sucrées"),
            array("Soda à la fraise allégé en sucre", "Boissons sucrées"),
            array("Vin rouge", "Alcools"),
            array("Vin blanc", "Alcools"),
            array("Vin rosé", "Alcools"),
            array("Champagne", "Alcools"),
            array("Cidre", "Alcools"),
            array("Bière", "Alcools"),
            array("Liqueur de mirabelles", "Alcools"),
            array("Eau de vie", "Alcools"),
            array("Hydromel au cassis", "Alcools"),
            array("Thé à la canneberge", "Thés")
        );
    }
    elseif ($theme == "vetements"){
        $listNames = array(
            "Chaussettes d'été",
            "Chaussettes d'hiver",
            "Combinaison en coton",
            "T-shirt col en V",
            "T-Shirt manches longues",
            "Débardeur en polyester",
            "Robe de chambre",
            "Chaussures de ville",
            "Bottines en jute",
            "Caleçon en lin",
            "Culotte en sisal",
            "Pantalon en chanvre",
            "Jupe en velour côtelé",
            "Chemise en toile",
            "Bonnet d'hiver"
        );
    }
    elseif ($theme == "bijoux"){
        $listNames = array(
            "Chevalière",
            "Bague",
            "Bracelet",
            "Collier",
            "Chaîne",
            "Pendentif",
            "Boucles d'oreilles",
            "Diadème",
            "Serre-tête",
            "Collier ras du cou",
            "Montre",
            "Piercing",
            "Chaîne de cheville",
            "Épingle à cheveux",
            "Bouton de manchette"
        );
    }
    $key = array_rand($listNames);
    $pNames = $listNames[$key];
    return array("pdtName" => $pNames[0], "pdtCategory" => $pNames[1]);
}

function generateCategories($theme){
    if($theme == "alimentation"){
        $listCategories = array(
            "Vins",
            "Mousseux",
            "Boissons sucrées",
            "Thés",
            "Alcools légers",
            "Spiritueux"
        );
        $key = array_rand($listCategories);
        $pCategories = $listCategories[$key];
        if (mt_rand(0, 2) == 1){
            $listSubCategories = array(
                "Bio",
                "Sans sulfites",
                "Vegan",
                "AOP",
                "AOC"
            );
            $key = array_rand($listSubCategories);
            $pSubCategories = $listSubCategories[$key];

            $pCategories .= ' > ' . $pSubCategories;
        }
    }
    elseif ($theme == "vetements"){
        $listCategories = array(
            "Chaussettes",
            "Combinaisons",
            "T-shirts",
            "Débardeurs",
            "Robes",
            "Jupes",
            "Chaussures",
            "Bottines",
            "Sous-vêtements",
            "Pantalons",
            "Chemises",
            "Bonnets"
        );
        $key = array_rand($listCategories);
        $pCategories = $listCategories[$key];
        if (mt_rand(0, 2) == 1){
            $listSubCategories = array(
                "Femme",
                "Enfant",
                "Homme",
                "Mixte"
            );
            $key = array_rand($listSubCategories);
            $pSubCategories = $listSubCategories[$key];

            $pCategories .= ' > ' . $pSubCategories;
        }
    }
    elseif ($theme == "bijoux"){
        $listCategories = array(
            "Bague",
            "Colliers",
            "Bracelets",
            "Chaînes",
            "Pendentifs",
            "Boucles",
            "Serre-têtes",
            "Montres",
            "Épingles",
            "Boutons de manchette",
            "Piercings",
            "Diadèmes"
        );
        $key = array_rand($listCategories);
        $pCategories = $listCategories[$key];
        if (mt_rand(0, 2) == 1){
            $listSubCategories = array(
                "Femme",
                "Enfant",
                "Homme",
                "Mixte"
            );
            $key = array_rand($listSubCategories);
            $pSubCategories = $listSubCategories[$key];

            $pCategories .= ' > ' . $pSubCategories;
        }
    }

    return $pCategories;
}

function globalGenerate($pTheme, $pType, $pVisibility, $pStock, $pDimensions, $pComments, $minPrice, $maxPrice, $limit){

    for($i = 1; $i <= $limit; $i++){
        $array[] = array(
            "ID" => "$i",
            "Type" => utf8_encode(generateType($pType)),
            "SKU" => utf8_encode(generateSku()),
            "Name" =>  generateNames($pTheme) . " " . generateProductCollection(6),
            "Published" => "1",
            "Is featured?" => "0",
            "Visibility in catalog" => utf8_encode(generateVisibility($pVisibility)),
            "Short description" => generateShortDescription(),
            "Description" => utf8_encode(generateDescription()),
            "Date sale price starts" => NULL,
            "Date sale price ends" => NULL,
            "Tax status" => "taxable",
            "Tax class" => NULL,
            "In stock?" => strval(generateStock($pStock)),
            "Stock" => NULL,
            "Backorders allowed?" => "0",
            "Sold individually?" => "0",
            "Weight (lbs)" => generateWeight(),
            "Length (in)" => utf8_encode(generateDimensions($pDimensions)),
            "Width (in)" => utf8_encode(generateDimensions($pDimensions)),
            "Height (in)" => utf8_encode(generateDimensions($pDimensions)),
            "Allow customer reviews?" => generateAllowedComments($pComments),
            "Purchase note" => NULL,
            "Sale price" => NULL,
            "Regular price" => utf8_encode(generatePrice($minPrice, $maxPrice)),
            "Categories" => generateCategories($pTheme)
        );
    }
    // arrayToJson($array);
    // jsonToCSV("results.json", "products.csv");
    return $array;

}
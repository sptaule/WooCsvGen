<?php

function arrayToJson($array, $instance){
    $fp = fopen('results-' . $instance . '.json', 'w');
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
    unlink($jfilename);
    return;
}

function stripBadChars($string){
    $unwanted_array = array(
        'Š'=>'S', 'š'=>'s', 'Ž'=>'Z', 'ž'=>'z', 'À'=>'A', 'Á'=>'A', 'Â'=>'A', 'Ã'=>'A', 'Ä'=>'A', 'Å'=>'A', 'Æ'=>'A', 'Ç'=>'C', 'È'=>'E', 'É'=>'E',
        'Ê'=>'E', 'Ë'=>'E', 'Ì'=>'I', 'Í'=>'I', 'Î'=>'I', 'Ï'=>'I', 'Ñ'=>'N', 'Ò'=>'O', 'Ó'=>'O', 'Ô'=>'O', 'Õ'=>'O', 'Ö'=>'O', 'Ø'=>'O', 'Ù'=>'U',
        'Ú'=>'U', 'Û'=>'U', 'Ü'=>'U', 'Ý'=>'Y', 'Þ'=>'B', 'ß'=>'Ss', 'à'=>'a', 'á'=>'a', 'â'=>'a', 'ã'=>'a', 'ä'=>'a', 'å'=>'a', 'æ'=>'a', 'ç'=>'c',
        'è'=>'e', 'é'=>'e', 'ê'=>'e', 'ë'=>'e', 'ì'=>'i', 'í'=>'i', 'î'=>'i', 'ï'=>'i', 'ð'=>'o', 'ñ'=>'n', 'ò'=>'o', 'ó'=>'o', 'ô'=>'o', 'õ'=>'o',
        'ö'=>'o', 'ø'=>'o', 'ù'=>'u', 'ú'=>'u', 'û'=>'u', 'ý'=>'y', 'þ'=>'b', 'ÿ'=>'y', ' ' => '-', '+' => '-plus'
    );
    return strtr($string, $unwanted_array);
}

function generateProductCollection($length){  
    $string = '';
    $voyelles = array("a","e","i","o","u");
    $consonnes = array(
        'b', 'c', 'd', 'f', 'g', 'h', 'j', 'k', 'l', 'm', 
        'n', 'p', 'r', 's', 't', 'v', 'w', 'x', 'y', 'z'
    );  
    mt_srand();
    $max = $length/2;
    for ($i = 1; $i <= $max; $i++) {
        $string .= $consonnes[mt_rand(0,19)];
        $string .= $voyelles[mt_rand(0,4)];
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
            "simple",
            "simple",
            "variable"
        );
        $key = array_rand($listTypes);
        $pType = $listTypes[$key];
        return $pType;
    }
    return NULL;
}

function generateSku($pName){
    // Replace all accented characters
    $unwanted_array = array(
        'Š'=>'S', 'š'=>'s', 'Ž'=>'Z', 'ž'=>'z', 'À'=>'A', 'Á'=>'A', 'Â'=>'A', 'Ã'=>'A', 'Ä'=>'A', 'Å'=>'A', 'Æ'=>'A', 'Ç'=>'C', 'È'=>'E', 'É'=>'E',
        'Ê'=>'E', 'Ë'=>'E', 'Ì'=>'I', 'Í'=>'I', 'Î'=>'I', 'Ï'=>'I', 'Ñ'=>'N', 'Ò'=>'O', 'Ó'=>'O', 'Ô'=>'O', 'Õ'=>'O', 'Ö'=>'O', 'Ø'=>'O', 'Ù'=>'U',
        'Ú'=>'U', 'Û'=>'U', 'Ü'=>'U', 'Ý'=>'Y', 'Þ'=>'B', 'ß'=>'Ss', 'à'=>'a', 'á'=>'a', 'â'=>'a', 'ã'=>'a', 'ä'=>'a', 'å'=>'a', 'æ'=>'a', 'ç'=>'c',
        'è'=>'e', 'é'=>'e', 'ê'=>'e', 'ë'=>'e', 'ì'=>'i', 'í'=>'i', 'î'=>'i', 'ï'=>'i', 'ð'=>'o', 'ñ'=>'n', 'ò'=>'o', 'ó'=>'o', 'ô'=>'o', 'õ'=>'o',
        'ö'=>'o', 'ø'=>'o', 'ù'=>'u', 'ú'=>'u', 'û'=>'u', 'ý'=>'y', 'þ'=>'b', 'ÿ'=>'y'
    );

    $words = explode(" ", strtr($pName, $unwanted_array));
    $acronym = "";

    foreach ($words as $word) {
        $acronym .= strtoupper($word[0]);
    }
    return $acronym . mt_rand(1000, 9999);
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
    $pDescription = file_get_contents('http://loripsum.net/api/1/long/plaintext');
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
    return intval($pPrice . $pDecimal);
}

/* Generate Names, Categories, Subcategories, Attributes */
function generateNames($theme, $attributes, $subattributes, $imagecount){
    /** Name - Category - Subcategory */
    $listNames = array();
    $listAttr = array();
    $attrValues = array();
    if($theme == "alimentation"){
        /* Refer to /data */
        include "data/alimentation/specs.php";
        include "data/alimentation/attr.php";
    }
    elseif ($theme == "vetements"){
        /* Refer to /data  */
        include "data/vetements/specs.php";
        include "data/vetements/attr.php";
    }
    elseif ($theme == "bijoux"){
        /* Refer to /data  */
        include "data/bijoux/specs.php";
        include "data/bijoux/attr.php";
    }
    // Names and categories
    $key = array_rand($listNames);
    $pNames = $listNames[$key]["Name"];
    isset($_POST["generatecategories"]) ? $pCategories = $listNames[$key]["Category"] : $pCategories = NULL;
    isset($_POST["generatesubcategories"]) ? $pSubCategories = " > " . $listNames[$key]["Subcategory"] : $pSubCategories = NULL;

    // Images
    $input = $listNames[$key]["Images"];
    $rand_keys = array_rand($input, 4);
    $pImagesGallery = NULL;
    for($i = 0; $i < $imagecount; $i++){
        if($i == $imagecount - 1){
            $pImagesGallery .= 'https://www.lucaschaplain.design/tools/woocsvgen/data/' . $theme . '/img/' . $input[$rand_keys[$i]] . '.jpg';
        }
        else {
            $pImagesGallery .= 'https://www.lucaschaplain.design/tools/woocsvgen/data/' . $theme . '/img/' . $input[$rand_keys[$i]] . '.jpg, ';
        }
    }

    // Attributes
    $keyAttr = array_rand($listAttr);
    $pAttrName = $listAttr[$keyAttr]["AttrName"];

    $pAttrValues = $listAttr[$keyAttr]["AttrValues"];
    shuffle($pAttrValues);
    $pAttrValue = NULL;
    $pAttrValueTwo = NULL;

    // Find already given attribute so next attribute will be different
    $givenAttrName = array_search($listAttr[$keyAttr], $listAttr);
    if (($givenAttrName >= 0 && $givenAttrName <= 3 && $attributes == 2)){
        $pAttrNameTwo = $listAttr[$keyAttr + 1]["AttrName"];
        $pAttrValuesTwo = $listAttr[$keyAttr + 1]["AttrValues"];
        shuffle($pAttrValuesTwo);
        // Lists all attributes values
        for($i = 0; $i < $subattributes; $i++){
            if($i == $subattributes - 1){
                $pAttrValueTwo .= $pAttrValuesTwo[$i];
            }
            else {
                $pAttrValueTwo .= $pAttrValuesTwo[$i] . ', ';
            }
        }
    }
    elseif ($givenAttrName == 4 && $attributes == 2){
        $pAttrNameTwo = $listAttr[$keyAttr - 1]["AttrName"];
        $pAttrValuesTwo = $listAttr[$keyAttr - 1]["AttrValues"];
        shuffle($pAttrValuesTwo);
        for($i = 0; $i < $subattributes; $i++){
            if($i == $subattributes - 1){
                $pAttrValueTwo .= $pAttrValuesTwo[$i];
            }
            else {
                $pAttrValueTwo .= $pAttrValuesTwo[$i] . ', ';
            }
        }
    }
    else {
        $pAttrNameTwo = NULL;
        $pAttrValueTwo = NULL;
    }


    // Lists all attributes values
    for($i = 0; $i < $subattributes; $i++){
        if($i == $subattributes - 1){
            $pAttrValue .= $pAttrValues[$i];
        }
        else {
            $pAttrValue .= $pAttrValues[$i] . ', ';
        }
    }

    $arrayProduct = array("pName" => $pNames, "pCategory" => $pCategories, "pSubCategory" => $pSubCategories, "pAttrName" => $pAttrName, "pAttrValue" => $pAttrValue, "pAttrNameTwo" => $pAttrNameTwo, "pAttrValueTwo" => $pAttrValueTwo, "pImagesGallery" => $pImagesGallery);
    return $arrayProduct;
}

function globalGenerate($pTheme, $pType, $pVisibility, $pStock, $pDimensions, $pComments, $minPrice, $maxPrice, $attributes, $subattributes, $imagecount, $limit){

    $shortdesc = generateShortDescription();
    $longdesc = generateDescription();

    for($i = 1; $i <= $limit; $i++){

        // Product price
        $regularPrice = generatePrice($minPrice, $maxPrice);
        $saleArray = array(0, 0, 0, 1);
        $randSale = array_rand($saleArray);
        if(isset($_POST["generatesaleprice"]) && $randSale == 1){
            $salePrice = number_format($regularPrice - (($regularPrice * 15) / 100), 2);
        }
        else{
            $salePrice = NULL;
        }

        // Random product name with its associated category and attributes
        $product = generateNames($pTheme, $attributes, $subattributes, $imagecount);

        // Generate Collections names ?
        isset($_POST["generatecollections"]) ? $generateCollections = " « " . generateProductCollection(6) . " »" : $generateCollections = NULL;

        // ---------------------------------------------------------------------- //
        // Generate main data array --------------------------------------------- //
        // ---------------------------------------------------------------------- //
        $array[] = array(
            "ID" => "$i",
            "Type" => utf8_encode(generateType($pType)),
            "SKU" => utf8_encode(generateSku($product["pName"])),
            "Name" =>  $product["pName"] . $generateCollections,
            "Published" => "1",
            "Is featured?" => "0",
            "Visibility in catalog" => utf8_encode(generateVisibility($pVisibility)),
            "Short description" => utf8_encode($shortdesc),
            "Description" => utf8_encode($longdesc),
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
            "Sale price" => $salePrice,
            "Regular price" => utf8_encode($regularPrice),
            "Categories" => $product["pCategory"] . $product["pSubCategory"],
            "Tags" => NULL,
            "Shipping class" =>  NULL,
            "Images" => $product["pImagesGallery"],
            "Download limit" => NULL,
            "Download expiry days" => NULL,
            "Parent" => NULL,
            "Grouped products" => NULL,
            "Upsells" => NULL,
            "Cross-sells" => NULL,
            "External URL" => NULL,
            "Button text" => NULL,
            "Position" => "0",
            "Attribute 1 name" => $product["pAttrName"],
            "Attribute 1 value(s)" => $product["pAttrValue"],
            "Attribute 1 visible" => "1",
            "Attribute 1 global" => "1",
            "Attribute 2 name" => $product["pAttrNameTwo"],
            "Attribute 2 value(s)" => $product["pAttrValueTwo"],
            "Attribute 2 visible" => "1",
            "Attribute 2 global" => "1",
            "Meta: _wpcom_is_markdown" => "1",
            "Download 1 name" => NULL,
            "Download 1 URL" => NULL,
            "Download 2 name" => NULL,
            "Download 2 URL" => NULL
        );
    }

    // Generate variations ...
    foreach ($array as $item){

        // ... only if product is 'variable' type
        if ($item["Type"] == "variable"){

            // Attributes and values
            $attrValues = explode(', ', $item["Attribute 1 value(s)"]);
            $countAttrValues = count($attrValues);

            // Generate id for variable product item (variations are 4 digits id)
            $idVar = mt_rand(1111, 9999);

            // Get a random image from product image gallery
            $pImages = explode(', ', $item["Images"]);
            $productImagesArray = array();
            foreach ($pImages as $pImage){
                $productImagesArray[] = $pImage;
            }
            $randImage = array_rand($productImagesArray);

            for ($i = 0; $i < $countAttrValues; $i++){

                // Increment id to get ids for variations that follows for same product
                $idVar++;

                // ---------------------------------------------------------------------- //
                // Insert the variation into existing main array ------------------------ //
                // ---------------------------------------------------------------------- //
                $array[] = array(
                    "ID" => "$idVar",
                    "Type" => "variation",
                    "SKU" => utf8_encode( $item["SKU"] . '-' . strtolower(stripBadChars($attrValues[$i]))),
                    "Name" =>  $item["Name"] . ' - ' . $attrValues[$i],
                    "Published" => "1",
                    "Is featured?" => "0",
                    "Visibility in catalog" => $item["Visibility in catalog"],
                    "Short description" => $item["Short description"],
                    "Description" => $item["Description"],
                    "Date sale price starts" => NULL,
                    "Date sale price ends" => NULL,
                    "Tax status" => "taxable",
                    "Tax class" => NULL,
                    "In stock?" => $item["In stock?"],
                    "Stock" => NULL,
                    "Backorders allowed?" => "0",
                    "Sold individually?" => "0",
                    "Weight (lbs)" => NULL,
                    "Length (in)" => NULL,
                    "Width (in)" => NULL,
                    "Height (in)" => NULL,
                    "Allow customer reviews?" => "0",
                    "Purchase note" => NULL,
                    "Sale price" => $item["Sale price"],
                    "Regular price" => $item["Regular price"],
                    "Categories" => NULL,
                    "Tags" => NULL,
                    "Shipping class" =>  NULL,
                    "Images" => $productImagesArray[$randImage],
                    "Download limit" => NULL,
                    "Download expiry days" => NULL,
                    "Parent" => $item["SKU"],
                    "Grouped products" => NULL,
                    "Upsells" => NULL,
                    "Cross-sells" => NULL,
                    "External URL" => NULL,
                    "Button text" => NULL,
                    "Position" => "0",
                    "Attribute 1 name" => $item["Attribute 1 name"],
                    "Attribute 1 value(s)" => $attrValues[$i],
                    "Attribute 1 visible" => NULL,
                    "Attribute 1 global" => "1",
                    "Attribute 2 name" => $item["Attribute 2 name"],
                    "Attribute 2 value(s)" => NULL,
                    "Attribute 2 visible" => NULL,
                    "Attribute 2 global" => "1",
                    "Meta: _wpcom_is_markdown" => "1",
                    "Download 1 name" => NULL,
                    "Download 1 URL" => NULL,
                    "Download 2 name" => NULL,
                    "Download 2 URL" => NULL
                );
            }
        }
    }

    // Generate random number for CSV file
    $instance = mt_rand(1000, 9999);

    // Directory where CSV file exists
    $baseUrl = "https://";
    $baseUrl .= $_SERVER['HTTP_HOST'];
    $baseUrl .= "/tools/woocsvgen/";

    // Generate JSON from array (will be deleted)
    arrayToJson($array, $instance);

    // Generate CSV from JSON just created
    jsonToCSV('results-' . $instance . '.json', 'products-' . $instance . '.csv');

    $fileUrl = $baseUrl . 'products-' . $instance . '.csv';
    $_SESSION["user"]["file"]["name"] = 'products-' . $instance;
    $_SESSION["user"]["file"]["time"] = date('H:i');
    header('Location:' . $baseUrl);

    // Script to delete old files runs every time a CSV is generated
    $folderName = basename(__DIR__);
    // Delete JSON files after 24 hours
    foreach (glob($folderName."*.json") as $file){
        if(time() - filectime($file) > 86400){
            unlink($file);
        }
    }
    // Delete CSV files after 24 hours
    foreach (glob($folderName."*.csv") as $file){
        if(time() - filectime($file) > 86400){
            unlink($file);
        }
    }

    /* Uncomment for debugging */
    // return $array;
}

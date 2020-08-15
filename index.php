<?php

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

session_start();

include 'functions.php';

header('Content-Type: text/html; charset=utf-8');

if(isset($_POST["generate"])){
	$theme = htmlspecialchars($_POST["producttheme"]);
	$type = htmlspecialchars($_POST["producttype"]);
	$visibility = htmlspecialchars($_POST["productvisibility"]);
	$stock = htmlspecialchars($_POST["productstock"]);
	$dimensions = htmlspecialchars($_POST["productdimensions"]);
	$comments = htmlspecialchars($_POST["productcomments"]);
	$minprice = htmlspecialchars($_POST["minprice"]);
	$maxprice = htmlspecialchars($_POST["maxprice"]);
	$attributes = htmlspecialchars($_POST["attributs"]);
	$subattributes = htmlspecialchars($_POST["sousattributs"]);
	$imagecount = htmlspecialchars($_POST["imagecount"]);
	$qty = htmlspecialchars($_POST["productqty"]);
    // var_dump(globalGenerate($theme, $type, $visibility, $stock, $dimensions, $comments, $minprice, $maxprice, $attributes, $subattributes, $imagecount, $qty));
    globalGenerate($theme, $type, $visibility, $stock, $dimensions, $comments, $minprice, $maxprice, $attributes, $subattributes, $imagecount, $qty);
}

?>

<!DOCTYPE html>
<html lang="fr">
<head>
	<meta charset="UTF-8">
	<title>WooCsvGen - Générateur CSV de produits WooCommerce</title>
	<link rel="stylesheet" href="style/style.css">
	<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bulma@0.9.0/css/bulma.min.css">
	<link href="https://fonts.googleapis.com/css2?family=Kanit:wght@200;500;800&display=swap" rel="stylesheet">
	<link rel="stylesheet" href="https://code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css"> 
	<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
	<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.min.js"></script>
	<link rel="stylesheet" href="style/rangeslider.css">
	<script src="script/rangeslider.min.js"></script>
</head>
<body>

	<div class="wrapper">
		
		<form action="" method="POST">

			<div class="grid-container">

			  <div class="Logo">
			  	<h1 class="subtitle is-1">Générateur CSV de produits WooCommerce</h1>
			  </div>

			  <div class="Theme">
			  	<section class="small">
					<h2>Thème</h2>
					<label class="container">Alimentation
					  <input type="radio" checked="checked" name="producttheme" value="alimentation">
					  <span class="checkmark"></span>
					</label>
					<label class="container">Vêtements
					  <input type="radio" name="producttheme" value="vetements">
					  <span class="checkmark"></span>
					</label>
					<label class="container">Bijoux
					  <input type="radio" name="producttheme" value="bijoux">
					  <span class="checkmark"></span>
					</label>
				</section>
			  </div>

			  <div class="Type">
			  	<section id="product-type">
					<h2>Type de produit</h2>
					<label class="container">Simple
					  <input type="radio" checked="checked" name="producttype" value="simple">
					  <span class="checkmark"></span>
					</label>
					<label class="container">Simple et variable (avec variations)
					  <input type="radio" name="producttype" value="simplevariable">
					  <span class="checkmark"></span>
					</label>
					<div id="collections">
						<h2 class="mt-4">Noms des produits</h2>
						<label class="container-checkbox">Générer des noms de collections <br><small>(exemple <?= '« ' . generateProductCollection(6) . ' »'; ?>)</small>
							<input type="checkbox" checked="checked" name="generatecollections">
							<span class="checkmark-box"></span>
						</label>
					</div>
				</section>
			  </div>

			  <div class="Visibility">
			  	<section>
					<h2>Visibilité dans le catalogue</h2>
					<label class="container">Visible
					  <input type="radio" checked="checked" name="productvisibility" value="visible">
					  <span class="checkmark"></span>
					</label>
					<label class="container">Caché
					  <input type="radio" name="productvisibility" value="hidden">
					  <span class="checkmark"></span>
					</label>
					<label class="container">Aléatoire
					  <input type="radio" name="productvisibility" value="random">
					  <span class="checkmark"></span>
					</label>
				</section>
			  </div>

			  <div class="Stock">
			  	<section>
					<h2>Stock</h2>
					<label class="container">En stock
					  <input type="radio" checked="checked" name="productstock" value="enstock">
					  <span class="checkmark"></span>
					</label>
					<label class="container">Pas en stock
					  <input type="radio" name="productstock" value="pasenstock">
					  <span class="checkmark"></span>
					</label>
					<label class="container">Aléatoire
					  <input type="radio" name="productstock" value="random">
					  <span class="checkmark"></span>
					</label>
				</section>
			  </div>

			  <div class="Dimensions">
			  	<section>
					<h2>Dimensions</h2>
					<label class="container">Petites (1 à 10 cm)
					  <input type="radio" checked="checked" name="productdimensions" value="petites">
					  <span class="checkmark"></span>
					</label>
					<label class="container">Moyennes (10 à 25 cm)
					  <input type="radio" name="productdimensions" value="moyennes">
					  <span class="checkmark"></span>
					</label>
					<label class="container">Grandes (35 à 65 cm)
					  <input type="radio" name="productdimensions" value="grandes">
					  <span class="checkmark"></span>
					</label>
					<label class="container">Aléatoires (1 à 65 cm)
					  <input type="radio" name="productdimensions" value="random">
					  <span class="checkmark"></span>
					</label>
				</section>
			  </div>

			  <div class="Commentaires">
			  	<section>
					<h2>Commentaires</h2>
					<label class="container">Autorisés
					  <input type="radio" checked="checked" name="productcomments" value="autorise">
					  <span class="checkmark"></span>
					</label>
					<label class="container">Non autorisés
					  <input type="radio" name="productcomments" value="nonautorise">
					  <span class="checkmark"></span>
					</label>
					<label class="container">Aléatoire
					  <input type="radio" name="productcomments" value="random">
					  <span class="checkmark"></span>
					</label>
				</section>
			  </div>

			  <div class="Prix">
			  	<section style="display: flex; align-items: center;">
                    <div style="width: 55%">
                        <h2>Prix minimum</h2>
                            <input id="range-control" type="range" min="5" max="50" step="5" value="5" name="minprice">
                            <span class="pricevalue minpricevalue">5 €</span>
                        <h2>Prix maximum</h2>
                            <input id="range-control-2" type="range" min="100" max="1000" step="10" value="100" name="maxprice">
                            <span class="pricevalue maxpricevalue">100 €</span>
                    </div>
                    <div style="width: 45%; padding: 0 15px; display: flex;">

                        <label class="container-checkbox">Promotions
                            <input type="checkbox" checked="checked" name="generatesaleprice">
                            <span class="checkmark-box"></span>
                        </label>
                    </div>
                </section>
			  </div>

			  <div class="Categories">
			  	<section>
					<h2>Catégories</h2>
                    <label class="container-checkbox">Générer des catégories
                        <input type="checkbox" checked="checked" name="generatecategories">
                        <span class="checkmark-box"></span>
                    </label>
					<h2>Sous-catégories</h2>
                    <label class="container-checkbox">Générer des sous-catégories
                        <input type="checkbox" checked="checked" name="generatesubcategories">
                        <span class="checkmark-box"></span>
                    </label>
				</section>
			  </div>

			  <div class="Attributs">
			  	<section>
					<h2>Attributs <small>(par produit)</small></h2>
					<input id="range-attr-1" type="range" min="0" max="2" step="1" value="1" name="attributs">
					<span class="pricevalue attrvalue">1</span>
					<h2>Valeurs <small>(par attribut)</small></h2>
					<input id="range-attr-2" type="range" min="0" max="5" step="1" value="3" name="sousattributs">
					<span class="pricevalue subattrvalue">3</span>
				</section>
			  </div>

                <div class="Gallery">
                    <section>
                        <h2>Images des produits</h2>
                        <span class="container-checkbox" style="padding-left: 0;">Nombre de photos par produit</span>
                        <input id="range-imagecount" type="range" min="0" max="4" step="1" value="3" name="imagecount">
                        <span class="imagecountvalue pricevalue subattrvalue">3</span>
                    </section>
                </div>

			  <div class="Qty">
			  	<section>
			  		<h2>Quantité de produits à générer</h2>
			  		<input id="range-qty" type="range" min="10" max="150" step="10" value="10" name="productqty">
					<span class="pricevalue productqtyvalue">10</span>
			  	</section>
			  </div>

			  <div class="Btn">
				  	<div class="control">
						<input type="submit" id="generate-btn" class="submit-button button is-primary" name="generate" value="Générer mon .csv">
					</div>
			  </div>

			  <div class="Loading" style="display: flex;flex-direction: column;justify-content: center;">
			  		<div id="loader" class="control">
				  		<img src="style/loading.svg" width="200px" style="margin: auto; display: block;">
					</div>
					<?php if(isset($_SESSION["user"]["file"]["name"]) && $_SESSION["user"]["file"]["name"] != NULL): ?>
			  			<a id="dl-link" href="https://www.lucaschaplain.design/tools/woocsvgen/<?= $_SESSION["user"]["file"]["name"]; ?>.csv" title="<?php echo $_SESSION["user"]["file"]["name"] . ' - ' . $_SESSION["user"]["file"]["time"]; ?>" style="text-align: center; color: pink; font-size: 1.75em; font-weight: bold;">Télécharger</a>
				  	<?php endif; ?>
			  </div>

			</div>

		</form>

        <div id="mentions">
            <svg height="32" viewBox="0 0 16 16" version="1.1" width="32" aria-hidden="true">
                <path fill-rule="evenodd" d="M8 0C3.58 0 0 3.58 0 8c0 3.54 2.29 6.53 5.47 7.59.4.07.55-.17.55-.38 0-.19-.01-.82-.01-1.49-2.01.37-2.53-.49-2.69-.94-.09-.23-.48-.94-.82-1.13-.28-.15-.68-.52-.01-.53.63-.01 1.08.58 1.23.82.72 1.21 1.87.87 2.33.66.07-.52.28-.87.51-1.07-1.78-.2-3.64-.89-3.64-3.95 0-.87.31-1.59.82-2.15-.08-.2-.36-1.02.08-2.12 0 0 .67-.21 2.2.82.64-.18 1.32-.27 2-.27.68 0 1.36.09 2 .27 1.53-1.04 2.2-.82 2.2-.82.44 1.1.16 1.92.08 2.12.51.56.82 1.27.82 2.15 0 3.07-1.87 3.75-3.65 3.95.29.25.54.73.54 1.48 0 1.07-.01 1.93-.01 2.2 0 .21.15.46.55.38A8.013 8.013 0 0016 8c0-4.42-3.58-8-8-8z"></path>
            </svg>
            <a href="https://github.com/sptaule/WooCsvGen">GitHub</a>
        </div>

	</div>

	<script>
		$("#generate-btn").click(function(){
			$("#dl-link").css("display", "none");
			$("#loader").css("display", "block");
		});
	</script>

<script src="script/script.js"></script>
	
</body>
</html>
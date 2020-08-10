<?php

include 'db.php';

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
	$categories = htmlspecialchars($_POST["categories"]);
	$subcategories = htmlspecialchars($_POST["souscategories"]);
	$attributes = htmlspecialchars($_POST["attributs"]);
	$subattributes = htmlspecialchars($_POST["sousattributs"]);
	$qty = htmlspecialchars($_POST["productqty"]);
	var_dump(globalGenerate($theme, $type, $visibility, $stock, $dimensions, $comments, $minprice, $maxprice, $qty));
}

?>

<!DOCTYPE html>
<html lang="fr">
<head>
	<meta charset="UTF-8">
	<title>Coucou</title>
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
					<label class="container">Simple et variable
					  <input type="radio" name="producttype" value="simplevariable">
					  <span class="checkmark"></span>
					</label>
					<div id="collections">
						<h2 class="mt-4">Collections</h2>
						<label class="container-checkbox">Générer des noms de collections
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
			  	<section>
					<h2>Prix minimum</h2>
					<input id="range-control" type="range" min="5" max="50" step="5" value="5" name="minprice">
					<span class="pricevalue minpricevalue">5 €</span>
					<h2>Prix maximum</h2>
					<input id="range-control-2" type="range" min="100" max="1000" step="10" value="100" name="maxprice">
					<span class="pricevalue maxpricevalue">100 €</span>
				</section>
			  </div>

			  <div class="Categories">
			  	<section>
					<h2>Catégories</h2>
					<input id="range-cat-1" type="range" min="1" max="15" step="1" value="1" name="categories">
					<span class="pricevalue catvalue">1</span>
					<h2>Sous-catégories</h2>
					<input id="range-cat-2" type="range" min="0" max="15" step="1" value="0" name="souscategories">
					<span class="pricevalue subcatvalue">0</span>
				</section>
			  </div>

			  <div class="Attributs">
			  	<section>
					<h2>Attributs</h2>
					<input id="range-attr-1" type="range" min="0" max="10" step="1" value="0" name="attributs">
					<span class="pricevalue attrvalue">0</span>
					<h2>Valeurs</h2>
					<input id="range-attr-2" type="range" min="0" max="10" step="1" value="0" name="sousattributs">
					<span class="pricevalue subattrvalue">0</span>
				</section>
			  </div>

			  <div class="Qty">
			  	<section>
			  		<h2>Quantité de produits à générer</h2>
			  		<input id="range-qty" type="range" min="10" max="100" step="10" value="10" name="productqty">
					<span class="pricevalue productqtyvalue">10</span>
			  	</section>
			  </div>

			  <div class="Btn">
				  	<div class="control">
						<input type="submit" class="button is-primary" name="generate" value="Générer mon .csv">
					</div>
			  </div>

			</div>

		</form>

	</div>

<script src="script/script.js"></script>
	
</body>
</html>
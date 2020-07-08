<?php 

include('publicatiemodel-definitie.php'); 
include('util.php'); 

?><!DOCTYPE html>
<html lang="nl">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="Datasets">
    <link href="../assets/imgs/nde_logo_simplified.png" rel="icon" type="image/png">
    <title>Dataset beschrijving in DCAT formaat</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.2/css/all.css" integrity="sha384-oS3vJWv+0UjzBfQzYUhtDYW+Pj2yciDJxpsK1OYPAYjqT085Qq/1cq5FLXAZQ7Ay" crossorigin="anonymous">
    <link href="../assets/css/main.css" rel="stylesheet" type="text/css">
    <link href="../assets/vendor/chosen/chosen.css" rel="stylesheet" type="text/css">
	<link href="../assets/css/forms.css" rel="stylesheet" type="text/css">
</head>

<body class="withNavbar withSink">
		<nav class="navbar fixed-top ">
			<div class="navbar-content">
				<div class="navbar-icon">
					<a class="navbar-brand" href="../"><img alt="Dataset Descriptions home" src="../assets/imgs/nde_logo.png"></a>
				</div>
				<div class="navbar-title">
					<a class="navbar-brand" href="../">Dataset Descriptions</a>|&nbsp;&nbsp;&nbsp;<a href="index.html">Formulieren</a>&nbsp;&nbsp;&nbsp;|&nbsp;&nbsp;&nbsp;Publicatiemodel (op basis van Schema.org/Dataset)
				</div>
			</div>
		</nav>
		<div class="container">
			<div class="row">
				<a id="dataset_examples" href="#" class="btn btn-info btn-sm float-right">Voorbeelddata</a>
				<h2 class="mt-5">Dataset beschrijving</h2>
				<div class="p-3 mb-2 bg-info text-white">
					<p class="text-center">Onderstaande formulier is gebaseerd op het <a target="_new" style="color:white;font-weight:bold;text-decoration:underline" href="https://github.com/netwerk-digitaal-erfgoed/project-organisations-datasets/tree/master/publication-model">Publication model for dataset descriptions</a>. Het formulier geleid de gebruiker in het beschrijven van de dataset en daarna de distributies van de dataset.</p>
					<p class="text-center"><img src="datacatalog-dataset-distribution.svg" style="max-width:100%;margin:0 32px"></p>
					<p class="text-center">Vul zo veel mogelijk van de onderstaande invoervelden in, minimaal de met een (*) gemarkeerde, verplichte invoervelden. Via een tooltip bij het label van een veld wordt er een beschrijving gegeven van het veld, wanneer er op een label geklikt wordt dan wordt de property beschrijving op schema.org geopend. De placeholder tekst van een veld geeft het datatype (range) aan. Een groene plus knop voegt een extra invoerveld of invoerveldenset (bij distributie) toe.<br>Wanneer er op de "Maak JSON-LD" knop wordt geklikt wordt er op basis van de invoer een te kopi&euml;ren blok JSON-LD gemaakt die in de eigen website op de dataset pagina ingevoegd dient te worden. Er worden geen gegevens opgeslagen, dit formulier heeft geen registratie functie.</p>
					<hr>
					<p class="text-center">Dit is een <strong>demonstrator</strong>, heeft is bedoeld om een indruk te geven van een dataset beschrijving. Het formulier implementeerd niet het volledige publicatiemodel, zo kunnen er alleen organisaties gekozen worden als eigenaar en verstrekker (een persoon is volgens het publicatie model ook mogelijk) en is er geen meertaligheid. Voor enkele properties zijn voor het gemak <a target="_new" style="color:white;text-decoration:underline" href="https://waardelijsten.dcat-ap-donl.nl/">waardelijsten gekoppeld van DCAT-AP-DONL</a>, deze stelt het publicatiemodel niet verplicht, maar adviseert het gebruik van waardelijsten wel.</p>
				</div>
				
			
				
				<br>
				<form id="dataset_form">
				<?php echo_datasetfields(); ?>

                <button class="btn btn-success" type="submit" id="do_script_jsonld">Maak JSON-LD</button>
				
				<a class="float-right btn btn-info" href="shacl/publicatiemodel.ttl" target="_new">SHACL (work in progress)</a>
				<a style="margin-right:10px" class="float-right btn btn-info" href="https://shacl.org/playground/" target="_new">SHACL Playground</a>
                <a style="margin-right:10px" class="float-right btn btn-info" href="https://search.google.com/test/rich-results" target="_new">Google's test voor uitgebreide resultaten</a>
                
            </form>

<!--
			<h4 class="mt-5">DCAT</h4>
            <pre id="id_script_jsonld_dcat"></pre>
-->		
			<h4 class="mt-5">Gegeneerde datasetbeschrijving in JSON-LD</h4>
            <pre id="id_script_jsonld_schema"></pre>
	
<!-- jQuery  -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
<script src="../assets/vendor/chosen/chosen.jquery.min.js"></script>
<!-- bootstrap -->
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.bundle.min.js" integrity="sha384-6khuMg9gaYr5AxOqhkVIODVIvm9ynTT5J4V1cfthmT+emCG6yVmEZsRHdxlotUnm" crossorigin="anonymous"></script>

<script>
	<?php echo_datasetscript(); ?>

	$(document).ready(function() {
		set_guid_elems();
		$('#dataset_form').on('submit', function() {
			make_script_jsonld();
			return false;
		});
		$('#dataset_examples').on('click', function() {
			fill_with_example_data();
			make_script_jsonld();
			return false;
		});
	});

	function set_guid_elems() {
		$(document).ready(function(){$('label').tooltip({placement:"right"});});
		selects.forEach(function (item, index) {
		  $("#"+item).chosen({width: "100%"});
		});
	}
	
	function plus(id) {
		part_html = $("#val_" + id  + " .multi").html();
		Object.keys(pluss).forEach(function(element) {
			if (element.substr(0, 3) == 'id_' && part_html.indexOf(element + "_") > -1) {
				re1 = new RegExp(element + "_0", "g");
				pluss[element]++;
				part_html = part_html.replace(re1, element + "_" + pluss[element]);				
				if (part_html.includes("<select")) {
					part_html = part_html.replace(/\<\/select\>.*$/si,'</select>');
					part_html = part_html.replace(/ style=\".*?\"/si,'</select>');
					selects.push(element + "_" + pluss[element]);
				}
			}
		});
		$("#val_" + id).append(part_html);
		set_guid_elems();
	}

	function uuidv4() {
		return ([1e7] + -1e3 + -4e3 + -8e3 + -1e11).replace(/[018]/g, c => (c ^ crypto.getRandomValues(new Uint8Array(1))[0] & 15 >> c / 4).toString(16));
	}


	function make_script_jsonld() {
<?php echo_script_jsonld_schema(); ?>

		jsonldString = JSON.stringify(schema	, null, '\t');

		script_jsonld = '&lt;script type="application/ld+json"&gt;' + "\n";
		script_jsonld += jsonldString;
		script_jsonld += "\n" + '&lt;/script&gt;';

		$("#id_script_jsonld_schema").html(script_jsonld);

	}


	/*

	TODO
	- Catalog boven Dataset en Distribution
	- Catalog waarden in localStorage opnemen
	- Meertaligheid toevoegen

	*/
    </script>

</body>
</html>
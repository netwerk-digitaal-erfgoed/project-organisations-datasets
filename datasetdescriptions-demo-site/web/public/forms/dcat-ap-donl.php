<?php

define('LANGUAGE','nl-NL');

$datasetfields=array();

$datasetfields[]=array(
	"id"=>"dataset_identifier",
	"example"=>"http://archief.io/id/B8CA13423A834E8CB9C23DF85F239E31",
	"label"=>"Permalink",
	"property_uri"=>"dct:identifier",
	"mandatory"=>1,
	"range"=>"xsd:anyURI",
	"title"=>"This property contains the main identifier for the Dataset, e.g. the URI or other unique identifier in the context of the Catalogue.",
	"script_dcat"=>'if ($("#id_dataset_identifier").val()) { dataset["@id"]=$("#id_dataset_identifier").val(); dataset["dct:identifier"]=$("#id_dataset_identifier").val(); }',
	"script_schema"=>'if ($("#id_dataset_identifier").val()) { schema["@id"]=$("#id_dataset_identifier").val(); schema["identifier"]=$("#id_dataset_identifier").val(); }'
);

$datasetfields[]=array(
	"id"=>"dataset_title",
	"label"=>"Naam",
	"example"=>"Voorbeeld dataset",
	"property_uri"=>"dct:title",
	"mandatory"=>1,
	"range"=>"xml:string",
	"title"=>"This property contains a free-text account of the Dataset. This property can be repeated for parallel language versions of the description.",
	"script_dcat"=>'if ($("#id_dataset_title").val()) { dataset["dct:title"]=$("#id_dataset_title").val(); }',
	"script_schema"=>'if ($("#id_dataset_title").val()) { schema["name"]=$("#id_dataset_title").val(); }'
);

$datasetfields[]=array(
	"id"=>"dataset_description",
	"label"=>"Beschrijving inhoud",
	"example"=>"Door het formulier vooringevulde, vaste waarden om het testen te vereenvoudigen.",
	"property_uri"=>"dct:description",
	"mandatory"=>1,
	"range"=>"xml:string",
	"title"=>"This property contains a name given to the Dataset. This property can be repeated for parallel language versions of the name.",
	"script_dcat"=>'if ($("#id_dataset_description").val()) { dataset["dct:description"]=$("#id_dataset_description").val(); }',
	"script_schema"=>'if ($("#id_dataset_description").val()) { schema["description"]=$("#id_dataset_description").val(); }'
);

$datasetfields[]=array(
	"id"=>"dataset_documentation",
	"label"=>"Webpagina voor meer informatie",
	"example"=>"http://demo.netwerkdigitaalerfgoed.nl/",
	"property_uri"=>"foaf:page",
	"range"=>"xsd:AnyURI",
	"title"=>"TODO",
	"script_dcat"=>'if ($("#id_dataset_documentation").val()) { dataset["foaf:page"]=$("#id_dataset_documentation").val(); }',
	"script_schema"=>'if ($("#id_dataset_documentation").val()) { schema["mainEntityOfPage"]=$("#id_dataset_documentation").val(); }'
);

$datasetfields[]=array(
	"id"=>"dataset_keyword",
	"label"=>"Tag",
	"example"=>"Test",
	"property_uri"=>"dcat:keyword",
	"multiple"=>1,
	"range"=>"xml:string",
	"title"=>"This property contains a keyword or tag describing the Dataset.",
	"script_dcat"=>'if ($("#id_dataset_keyword_0").val()) { var keyword_idx=0; dataset["dcat:keyword"]=[]; while ($("#id_dataset_keyword_"+keyword_idx).val()) { dataset["dcat:keyword"].push($("#id_dataset_keyword_"+keyword_idx).val()); keyword_idx++; }}',
	"script_schema"=>'if ($("#id_dataset_keyword_0").val()) { var keyword_idx=0; schema["keywords"]=[]; while ($("#id_dataset_keyword_"+keyword_idx).val()) { schema["keywords"].push($("#id_dataset_keyword_"+keyword_idx).val()); keyword_idx++; }}'
);

$datasetfields[]=array(
	"id"=>"dataset_metadataLanguage",
	"label"=>"Taal metadata",
	"example"=>"http://publications.europa.eu/resource/authority/language/NLD",
	"property_uri"=>"dct:language",
	"mandatory"=>1,
	"select"=>"donl_language",
	"range"=>"donl:language",
	"title"=>"This property refers to a language used in the textual metadata describing titles, descriptions, etc. of the Dataset. This property can be repeated if the metadata is provided in multiple languages.",
	"script_dcat"=>'if ($("#id_dataset_metadataLanguage").val() != "") { dataset["dct:language"]={"@id":$("#id_dataset_metadataLanguage").val()}; }',
	"script_schema"=>'if ($("#id_dataset_metadataLanguage").val() != "") { 
	
	if ($("#id_distribution_"+dataset_idx+"_language_"+lang_idx).val()=="http://publications.europa.eu/resource/authority/language/NLD") { schema["inLanguage"].push("nl-NL"); }
	if ($("#id_distribution_"+dataset_idx+"_language_"+lang_idx).val()=="http://publications.europa.eu/resource/authority/language/ENG") { schema["inLanguage"].push("en-US"); }
	if ($("#id_distribution_"+dataset_idx+"_language_"+lang_idx).val()=="http://publications.europa.eu/resource/authority/language/FRY") { schema["inLanguage"].push("nl-FY"); }
	}'
);


/* net als vorige uri dct:language - voelt niet goed
$datasetfields[]=array(
	"id"=>"dataset_language",
	"label"=>"Taal",
	"example"=>"http://publications.europa.eu/resource/authority/language/NLD",
	"property_uri"=>"dct:language",
	"mandatory"=>1,
	"multiple"=>1,
	"select"=>"donl_language",
	"range"=>"donl:language",
	"title"=>"This property refers to a language used in the textual metadata describing titles, descriptions, etc. of the Dataset. This property can be repeated if the metadata is provided in multiple languages.",
	"script_dcat"=>'if ($("#id_dataset_language").val() != "") { dataset["dct:language"]=$("#id_dataset_language").val(); }'
);
*/

$datasetfields[]=array(
	"id"=>"dataset_theme",
	"label"=>"Thema",
	"example"=>"http://standaarden.overheid.nl/owms/terms/Recreatie_(thema)",
	"property_uri"=>"dcat:theme",
	"mandatory"=>1,
	"multiple"=>1,
	"select"=>"overheid_taxonomiebeleidsagenda",
	"range"=>"overheid:taxonomiebeleidsagenda",
	"title"=>"This property refers to TODO.",
	"script_dcat"=>'if ($("#id_dataset_theme_0").val()) { var idx=0; dataset["dcat:theme"]=[]; while ($("#id_dataset_theme_"+idx).val()) { dataset["dcat:theme"].push({"@id":$("#id_dataset_theme_"+idx).val()}); idx++; }}'
);


$datasetfields[]=array(
	"id"=>"dataset_modificationDate",
	"label"=>"Wijzigingsdatum",
	"example"=>"2020-03-31",
	"mandatory"=>1,
	"property_uri"=>"dct:modified",
	"range"=>"xsd:date",
	"title"=>"This property contains the most recent date on which the Dataset was changed or modified.",
	"script_dcat"=>'if ($("#id_dataset_modificationDate").val()) { dataset["dct:modified"]={}; dataset["dct:modified"]["@type"]="xsd:dateTime"; dataset["dct:modified"]["@value"]=$("#id_dataset_modificationDate").val(); }',
	"script_schema"=>'if ($("#id_dataset_modificationDate").val()) { schema["dateModified"]=$("#id_dataset_modificationDate").val(); }'
);


$datasetfields[]=array(
	"id"=>"dataset_authority",
	"label"=>"Data-eigenaar",
	"example"=>"http://standaarden.overheid.nl/owms/terms/Ministerie_van_Onderwijs,_Cultuur_en_Wetenschap",
	"mandatory"=>1,
	"property_uri"=>"overheid:authority",	
	"range"=>"donl:authority",
	"select"=>"donl_organization",
	"title"=>"This property refers to an entity (organisation) responsible for making the Dataset available.",
	"script_dcat"=>'if ($("#id_dataset_authority").val()) { var authority={}; authority["@id"]=$("#id_dataset_authority").val(); authority["@type"]="foaf:Agent"; authority["foaf:name"]=$("#id_dataset_authority option:selected").text(); dcat["@graph"].push(authority); dataset["overheid.authority"]={}; dataset["overheid.authority"]["@id"]=authority["@id"]; }'
);

$datasetfields[]=array(
	"id"=>"dataset_publisher",
	"label"=>"Verstrekker",
	"example"=>"http://standaarden.overheid.nl/owms/terms/Nationaal_Archief",
	"property_uri"=>"dct:publisher",
	"mandatory"=>1,
	"range"=>"donl:authority",
	"select"=>"donl_organization",
	"title"=>"This property refers to an entity (organisation) responsible for making the Dataset available.",
	"script_dcat"=>'if ($("#id_dataset_publisher").val()) { var publisher={}; publisher["@id"]=$("#id_dataset_publisher").val(); publisher["@type"]="foaf:Agent"; publisher["foaf:name"]=$("#id_dataset_publisher option:selected").text(); dcat["@graph"].push(publisher); dataset["dct:publisher"]={}; dataset["dct:publisher"]["@id"]=publisher["@id"]; }',
	
	"script_schema"=>'if ($("#id_dataset_publisher").val()) { var publisher={}; publisher["@id"]=$("#id_dataset_publisher").val(); publisher["@type"]="Organization"; publisher["name"]=$("#id_dataset_publisher option:selected").text(); schema["publisher"]=publisher; }'
);


$datasetfields[]=array(
	"id"=>"dataset_releaseDate",
	"label"=>"Datum van uitgave",
	"example"=>"2020-03-30",
	"property_uri"=>"dct:issued",
	"range"=>"xsd:date",
	"title"=>"This property contains the date of formal issuance (e.g., publication) of the Dataset.",
	"script_dcat"=>'if ($("#id_dataset_releaseDate").val()) { dataset["dct:issued"]={}; dataset["dct:issued"]["@type"]="xsd:dateTime"; dataset["dct:issued"]["@value"]=$("#id_dataset_releaseDate").val(); }',
	"script_schema"=>'if ($("#id_dataset_releaseDate").val()) { schema["datePublished"]=$("#id_dataset_releaseDate").val(); }'

);

$datasetfields[]=array(
	"id"=>"dataset_contactPoint",
	"label"=>"Contactgegevens",
	"mandatory"=>1,
	"property_uri"=>"dcat:contactPoint",
	"range"=>"vcard:Kind",
	"title"=>"This property contains contact information that can be used for sending comments about the Dataset.",
	"script_dcat"=>'if ($("#id_vcard_fn").val() || $("#id_vcard_hasEmail").val()) { var contact={}; if ($("#id_vcard_identifier").val()) { contact["@id"]=$("#id_vcard_identifier").val(); } else { contact["@id"]="_:"+uuidv4(); } contact["@type"]=$("input[name=\'id_vcard_Organization\']:checked").val(); if ($("#id_vcard_fn").val()) { contact["foaf:name"]=$("#id_vcard_fn").val(); } if ($("#id_vcard_hasEmail").val()) { contact["foaf:mbox"]=$("#id_vcard_hasEmail").val(); } dataset["dcat:contactPoint"]={}; dataset["dcat:contactPoint"]["@id"]=contact["@id"]; dcat["@graph"].push(contact); }',
	
	"script_schema"=>'if ($("#id_vcard_fn").val() || $("#id_vcard_hasEmail").val()) { var contact={}; if ($("#id_vcard_identifier").val()) { contact["@id"]=$("#id_vcard_identifier").val(); } else { contact["@id"]="_:"+uuidv4(); } contact["@type"]=$("input[name=\'id_vcard_Organization\']:checked").val();  if ($("#id_vcard_fn").val()) { contact["foaf:name"]=$("#id_vcard_fn").val(); } if ($("#id_vcard_hasEmail").val()) { contact["foaf:mbox"]=$("#id_vcard_hasEmail").val(); } schema["creator"]=[];  schema["creator"]["contactPoint"]=contact; }'
);

$datasetfields[]=array(
	"id"=>"dataset_distribution",
	"label"=>"Distributie",
	"mandatory"=>1,
	"multiple"=>1,
	"property_uri"=>"dcat:distribution",
	"range"=>"dcat:Distribution",
	"title"=>"This property links the Dataset to an available Distribution."
);

$distributionfields=array();

$distributionfields[]=array(
	"id"=>"distribution_0_accessURL",
	"label"=>"Toegangs URL",
	"example"=>"http://archief.io/dataset/B8CA13423A834E8CB9C23DF85F239E31",
	"class"=>"distribution_first",
	"property_uri"=>"dcat:accessURL",
	"mandatory"=>1,
	"range"=>"xsd:anyURI",
	"title"=>"This property contains a URL that gives access to a Distribution of the Dataset. The resource at the access URL may contain information about how to get the Dataset.",
	"script_dcat"=>'distribution["dcat:accessURL"]={}; distribution["dcat:accessURL"]["@id"]=$("#id_distribution_"+dataset_idx+"_accessURL").val();',
	"script_schema"=>'distribution["contentURL"]=$("#id_distribution_"+dataset_idx+"_accessURL").val();'
);

$distributionfields[]=array(
	"id"=>"distribution_0_downloadURL",
	"label"=>"Download URL",
	"example"=>"http://archief.io/download/B8CA13423A834E8CB9C23DF85F239E31",
	"property_uri"=>"dcat:downloadURL",
	"range"=>"xsd:anyURI",
	"title"=>"This property contains a URL that is a direct link to a downloadable file in a given format.",
	"script_dcat"=>'if ($("#id_distribution_"+dataset_idx+"_downloadURL").val()) { distribution["dcat:downloadURL"]={}; distribution["dcat:downloadURL"]["@id"]=$("#id_distribution_"+dataset_idx+"_downloadURL").val(); }'
);

$distributionfields[]=array(
	"id"=>"distribution_0_license",
	"label"=>"Licentie",
	"example"=>"http://creativecommons.org/publicdomain/zero/1.0/deed.nl",
	"mandatory"=>1,
	"property_uri"=>"dct:license",
	"range"=>"overheid:license",
	"select"=>"overheid_license",
	"title"=>"This property refers to the licence under which the Distribution is made available.",
	"script_dcat"=>'if ($("#id_distribution_"+dataset_idx+"_license").val() != "") { distribution["dcat:license"]=$("#id_distribution_"+dataset_idx+"_license").val(); }',
	"script_schema"=>'if ($("#id_distribution_"+dataset_idx+"_license").val() != "") { distribution["license"]=$("#id_distribution_"+dataset_idx+"_license").val(); }'
);

$distributionfields[]=array(
	"id"=>"distribution_0_title",
	"label"=>"Titel",
	"example"=>"N-Triples",
	"property_uri"=>"dct:title",
	"range"=>"xml:string",
	"mandatory"=>1,
	"title"=>"This property contains a name given to the Distribution. This property can be repeated for parallel language versions of the description.",
	"script_dcat"=>'if ($("#id_distribution_"+dataset_idx+"_title").val()) { distribution["dct:title"]=$("#id_distribution_"+dataset_idx+"_title").val(); }',
	"script_schema"=>'if ($("#id_distribution_"+dataset_idx+"_title").val()) { distribution["name"]=$("#id_distribution_"+dataset_idx+"_title").val(); }'
);

$distributionfields[]=array(
	"id"=>"distribution_0_description",
	"label"=>"Omschrijving",
	"example"=>"Heleboel triple statements",
	"property_uri"=>"dct:description",
	"range"=>"xml:string",
	"mandatory"=>1,
	"title"=>"This property contains a free-text account of the Distribution. This property can be repeated for parallel language versions of the description.",
	"script_dcat"=>'if ($("#id_distribution_"+dataset_idx+"_description").val()) { distribution["dct:description"]=$("#id_distribution_"+dataset_idx+"_description").val(); }',
	"script_schema"=>'if ($("#id_distribution_"+dataset_idx+"_description").val()) { distribution["description"]=$("#id_distribution_"+dataset_idx+"_description").val(); }'
);

$distributionfields[]=array(
	"id"=>"distribution_0_language",
	"label"=>"Taal",
	"example"=>"http://publications.europa.eu/resource/authority/language/ENG",
	"property_uri"=>"dct:language",
	"mandatory"=>1,
	"multiple"=>1,
	"select"=>"donl_language",
	"range"=>"donl:language",
	"title"=>"TODO",
	"script_dcat"=>'if ($("#id_distribution_"+dataset_idx+"_language_0").val()!="") { var lang_idx=0; distribution["dct:language"]=[]; while ($("#id_distribution_"+dataset_idx+"_language_"+lang_idx).val()) { distribution["dct:language"].push({"@id":$("#id_distribution_"+dataset_idx+"_language_"+lang_idx).val()}); lang_idx++; }}',
	
	
	"script_schema"=>'if ($("#id_distribution_"+dataset_idx+"_language_0").val()!="") { var lang_idx=0; distribution["inLanguage"]=[]; while ($("#id_distribution_"+dataset_idx+"_language_"+lang_idx).val()) {
	if ($("#id_distribution_"+dataset_idx+"_language_"+lang_idx).val()=="http://publications.europa.eu/resource/authority/language/NLD") { distribution["inLanguage"].push("nl-NL"); }
	if ($("#id_distribution_"+dataset_idx+"_language_"+lang_idx).val()=="http://publications.europa.eu/resource/authority/language/ENG") { distribution["inLanguage"].push("en-US"); }
	if ($("#id_distribution_"+dataset_idx+"_language_"+lang_idx).val()=="http://publications.europa.eu/resource/authority/language/FRY") { distribution["inLanguage"].push("nl-FY"); }
	
		lang_idx++; }}'
);

$distributionfields[]=array(
	"id"=>"distribution_0_format",
	"label"=>"Formaat",
	"example"=>"http://publications.europa.eu/resource/authority/file-type/RDF_TURTLE",
	"mandatory"=>1,
	"property_uri"=>"dct:format",
	"select"=>"mdr_filetype_nal",
	"range"=>"mdr:filetype",
	"title"=>"This property refers to the file format of the Distribution.",
	"script_dcat"=>'if ($("#id_distribution_"+dataset_idx+"_format").val()) { distribution["dct:format"]={"@id":$("#id_distribution_"+dataset_idx+"_format").val()}; }',
	"script_schema"=>'if ($("#id_distribution_"+dataset_idx+"_format").val()) { distribution["encodingFormat"]=$("#id_distribution_"+dataset_idx+"_format").val(); }'

);


$distributionfields[]=array(
	"id"=>"distribution_0_releaseDate",
	"label"=>"Publicatiedatum",
	"example"=>"2020-03-27",
	"property_uri"=>"dct:issued",
	"range"=>"xsd:date",
	"title"=>"This property contains the most recent date on which the Dataset was released.",
	"script_dcat"=>'if ($("#id_distribution_"+dataset_idx+"_releaseDate").val()) { distribution["dcat:modified"]=$("#id_distribution_"+dataset_idx+"_releaseDate").val(); }',
	"script_schema"=>'if ($("#id_distribution_"+dataset_idx+"_releaseDate").val()) { distribution["datePublished"]=$("#id_distribution_"+dataset_idx+"_releaseDate").val()+"T00:00:00+00:00"; }'
);


$distributionfields[]=array(
	"id"=>"distribution_0_modificationDate",
	"label"=>"Wijzigingsdatum",
	"example"=>"2020-03-28",
	"property_uri"=>"dct:modified",
	"range"=>"xsd:date",
	"title"=>"This property contains the most recent date on which the Dataset was changed or modified.",
	"script_dcat"=>'if ($("#id_distribution_"+dataset_idx+"_modificationDate").val()) { distribution["dcat:modified"]=$("#id_distribution_"+dataset_idx+"_modificationDate").val(); }',
	"script_schema"=>'if ($("#id_distribution_"+dataset_idx+"_modificationDate").val()) { distribution["dateModified"]=$("#id_distribution_"+dataset_idx+"_modificationDate").val()+"T00:00:00+00:00"; }'
);

$distributionfields[]=array(
	"id"=>"distribution_0_mediaType",
	"label"=>"Media type",
	"example"=>"https://www.iana.org/assignments/media-types/text/turtle",
	"property_uri"=>"dcat:mediaType",
	"range"=>"dcat:mediaType",
	"select"=>"iana_mediatypes",
	"title"=>"This property refers to the media type of the Distribution as defined in the official register of media types managed by IANA.",
	"script_dcat"=>'if ($("#id_distribution_"+dataset_idx+"_mediaType").val()) { distribution["dcat:mediaType"]={"@id":$("#id_distribution_"+dataset_idx+"_mediaType").val()}; }'
);


$contactPointfields=array();

$contactPointfields[]=array(
	"id"=>"vcard_identifier",
	"label"=>"Identifier",
	"range"=>"vcard:identifier",
	"class"=>"vcard",
	"property_uri"=>"dct:identifier",
	"title"=>"TODO"
);

$contactPointfields[]=array(
	"id"=>"vcard_Organization",
	"label"=>"Soort",
	"range"=>"vcard:Individual or vcard:Organization",
	"radio"=> array(array("id"=>1,"value"=>"vcard:Organization", "label"=>"Organisatie"),array("id"=>2,"value"=>"vcard:Individual", "label"=>"Persoon")),
	"example"=>"vcard:Individual",
	"property_uri"=>"dct:identifier",  # klopt dit?
	"class"=>"vcard",
	"title"=>"TODO"
);
$contactPointfields[]=array(
	"id"=>"vcard_fn",
	"label"=>"Naam",
	"example"=>"T. Ester",
	"range"=>"vcard:fn",
	"property_uri"=>"vcard:fn",
	"class"=>"vcard",
	"title"=>"TODO"
);

$contactPointfields[]=array(
	"id"=>"vcard_hasEmail",
	"label"=>"E-mail",
	"example"=>"voorbeeld@nde.nl",
	"range"=>"vcard:hasEmail",
	"property_uri"=>"vcard:hasEmail",
	"class"=>"vcard",
	"title"=>"TODO"
);

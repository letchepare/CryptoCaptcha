<?php

function cryptocaptcha_insert_head($texte){
	$texte .= "<script src='https://www.google.com/recaptcha/api.js'></script>"."\n";
	return $texte;
}

function cryptocaptcha_init_tables_principales($tables_principales){
	$nouvelletable = array(
		"id" => "INT(1) NOT NULL",
		"cleprivee" => "VARCHAR(256) DEFAULT 'clé privée'",
		"clesite"=> "VARCHAR(256) DEFAULT 'clé de site",
		);

	$cles_nouvelletable = array(
		"PRIMARY KEY" => "id",
		);

	$join_nouvelletable = array();

	$tables_principales['spip_captcha'] = array(
		'field'=>&$nouvelletable,
		'key' => &$cles_nouvelletable,
		'join' => &$join_nouvelletable,
		);
	return $tables_principales;

}

?> 
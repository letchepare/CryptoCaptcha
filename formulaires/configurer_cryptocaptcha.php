<?php
if (!defined('_ECRIRE_INC_VERSION')) return;
function formulaires_configurer_cryptocaptcha_charger_dist(){
	
	$valeurs = array('cleSite'=>"",'clePrivee'=>"");
	
	return $valeurs;
}
function formulaires_configurer_cryptocaptcha_verifier_dist(){
	$erreurs = array();
	// verifier que les champs obligatoires sont bien la :
	if (count($erreurs))
		$erreurs['message_erreur'] = 'Votre saisie contient des erreurs !';
	return $erreurs;
}


function formulaires_configurer_cryptocaptcha_traiter_dist(){
	$clePrivee=$_REQUEST['saisieClePrivee'];
	$cleSite=$_REQUEST['saisieCleSite'];
	$type=$_REQUEST['type'];
	sql_updateq('spip_captcha', array('cleprivee' => "$clePrivee",'clesite'=>"$cleSite",'type' => "$type"), "id=1");
	return array(
		'message_ok' => 'Enregistrement effectué !'
		);
}
?>	
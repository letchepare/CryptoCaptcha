<?php


function traiterCaptcha($POST){

	if (isset($POST['g-recaptcha-response'])) {
		$tokenUtilisateur = $POST['g-recaptcha-response'];
	}else{
		$tokenUtilisateur = $POST['coinhive-captcha-token'];
	}
	$captchaValide = getReponseCaptcha($tokenUtilisateur);
	return $captchaValide;
}

function getReponseCaptcha($tokenUtilisateur){
	$reponse = false;
	// Récupération de la clé privée dans la base
	if ($r = sql_select(array('cleprivee', 'type'),'spip_captcha', 'id=1')) {
		while ($ligne = sql_fetch($r)) {
			$secret = $ligne['cleprivee'];
			$type = $ligne['type'];
		}
	}


	if($type=="google"){

		// On récupère l'IP de l'utilisateur
			$remoteip = $_SERVER['REMOTE_ADDR'];
			$api_url = "https://www.google.com/recaptcha/api/siteverify?secret="
			. $secret
			. "&response=" . $tokenUtilisateur
			. "&remoteip=" . $remoteip ;
			$decode = json_decode(file_get_contents($api_url), true);
			$reponse = $decode["success"];

	}else{
		$post_data = [
				'secret' => $secret, // <- Your secret key
				'token' => $tokenUtilisateur,
				'hashes' => 1024
			];
		$post_context = stream_context_create([
				'http' => [
				'header'  => "Content-type: application/x-www-form-urlencoded\r\n",
				'method'  => 'POST',
				'content' => http_build_query($post_data)
				]
			]);
	$url = 'https://api.coinhive.com/token/verify';
	$decode = json_decode(file_get_contents($url, false, $post_context));
	$reponse = $decode->success;
	

	
	}

	return $reponse;
}
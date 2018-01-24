<?php
/**
 * Utilisation de l'action supprimer pour l'objet captcha
 *
 * @plugin     cryptocaptcha
 * @copyright  2018
 * @author     Lartigue Benjamin et Etchepare Lilian
 * @licence    GNU/GPL
 * @package    SPIP\Cryptocaptcha\Action
 */

if (!defined('_ECRIRE_INC_VERSION')) {
	return;
}



/**
 * Action pour supprimer un·e captcha
 *
 * Vérifier l'autorisation avant d'appeler l'action.
 *
 * @example
 *     ```
 *     [(#AUTORISER{supprimer, captcha, #ID}|oui)
 *         [(#BOUTON_ACTION{<:captcha:supprimer_captcha:>,
 *             #URL_ACTION_AUTEUR{supprimer_captcha, #ID, #URL_ECRIRE{captcha}},
 *             danger, <:captcha:confirmer_supprimer_captcha:>})]
 *     ]
 *     ```
 *
 * @example
 *     ```
 *     [(#AUTORISER{supprimer, captcha, #ID}|oui)
 *         [(#BOUTON_ACTION{
 *             [(#CHEMIN_IMAGE{captcha-del-24.png}|balise_img{<:captcha:supprimer_captcha:>}|concat{' ',#VAL{<:captcha:supprimer_captcha:>}|wrap{<b>}}|trim)],
 *             #URL_ACTION_AUTEUR{supprimer_captcha, #ID, #URL_ECRIRE{captcha}},
 *             icone s24 horizontale danger captcha-del-24, <:captcha:confirmer_supprimer_captcha:>})]
 *     ]
 *     ```
 *
 * @example
 *     ```
 *     if (autoriser('supprimer', 'captcha', $id)) {
 *          $supprimer_captcha = charger_fonction('supprimer_captcha', 'action');
 *          $supprimer_captcha($id);
 *     }
 *     ```
 *
 * @param null|int $arg
 *     Identifiant à supprimer.
 *     En absence de id utilise l'argument de l'action sécurisée.
**/
function action_supprimer_captcha_dist($arg=null) {
	if (is_null($arg)){
		$securiser_action = charger_fonction('securiser_action', 'inc');
		$arg = $securiser_action();
	}
	$arg = intval($arg);

	// cas suppression
	if ($arg) {
		sql_delete('spip_captcha',  'id=' . sql_quote($arg));
	}
	else {
		spip_log("action_supprimer_captcha_dist $arg pas compris");
	}
}

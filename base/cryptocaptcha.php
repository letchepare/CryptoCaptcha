<?php
/**
 * Déclarations relatives à la base de données
 *
 * @plugin     cryptocaptcha
 * @copyright  2018
 * @author     Lartigue Benjamin et Etchepare Lilian
 * @licence    GNU/GPL
 * @package    SPIP\Cryptocaptcha\Pipelines
 */

if (!defined('_ECRIRE_INC_VERSION')) {
	return;
}


/**
 * Déclaration des alias de tables et filtres automatiques de champs
 *
 * @pipeline declarer_tables_interfaces
 * @param array $interfaces
 *     Déclarations d'interface pour le compilateur
 * @return array
 *     Déclarations d'interface pour le compilateur
 */
function cryptocaptcha_declarer_tables_interfaces($interfaces) {

	$interfaces['table_des_tables']['captcha'] = 'captcha';

	return $interfaces;
}


/**
 * Déclaration des objets éditoriaux
 *
 * @pipeline declarer_tables_objets_sql
 * @param array $tables
 *     Description des tables
 * @return array
 *     Description complétée des tables
 */
function cryptocaptcha_declarer_tables_objets_sql($tables) {

	$tables['spip_captcha'] = array(
		'type' => 'captcha',
		'principale' => 'oui',
		'table_objet_surnoms' => array('captcha'), // table_objet('captcha') => 'captcha' 
		'field'=> array(
			'id'                 => 'bigint(21) NOT NULL',
			'cleprivee'          => 'varchar(256) DEFAULT "clé privée"',
			'clesite'            => 'varchar(256) DEFAULT "clé de site"',
			'type'				 => 'varchar(25) DEFAULT "google"'
		),
		'key' => array(
			'PRIMARY KEY'        => 'id',
		),
		'titre' => '"" AS titre, "" AS lang',
		 #'date' => '',
		'champs_editables'  => array('cleprivee'),
		'champs_versionnes' => array(),
		'rechercher_champs' => array(),
		'tables_jointures'  => array(),


	);

	return $tables;
}

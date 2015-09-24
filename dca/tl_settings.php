<?php

/**
 * Contao Open Source CMS
 *
 * Copyright (c) 2005-2015 Leo Feyer
 *
 * @package   refererSpamBlocker
 * @author    Frank Thonak (www.thomkit.de)
 * @license   LGPL
 * @copyright Martin Schwenzer (www.derhaeuptling.com) 2015
 */


/**
 * Add to palette
 */
$GLOBALS['TL_DCA']['tl_settings']['palettes']['default'] .= ';{referer_legend:hide},referer_active,referer_source';


/**
 * Add fields
 */
$GLOBALS['TL_DCA']['tl_settings']['fields']['referer_source'] = array
(
	'label'		=> &$GLOBALS['TL_LANG']['tl_settings']['referer_source'],
	'inputType'	=> 'text',
	'eval'		=> array('maxlength'=>255, 'rgxp'=>'url', 'placeholder'=>'https://raw.githubusercontent.com/piwik/referrer-spam-blacklist/master/spammers.txt')
);

$GLOBALS['TL_DCA']['tl_settings']['fields']['referer_active'] = array
(
	'label'		=> &$GLOBALS['TL_LANG']['tl_settings']['referer_active'],
	'inputType'	=> 'checkbox',
	'eval'      => array()
);
<?php

/**
 * Contao Open Source CMS
 *
 * Copyright (c) 2005-2015 Leo Feyer
 *
 * @license LGPL-3.0+
 */


/**
 * Register the namespaces
 */
ClassLoader::addNamespaces(array
(
	'Thomkit',
));


/**
 * Register the classes
 */
ClassLoader::addClasses(array
(
	// Classes
	'Thomkit\idna_convert'  => 'system/modules/referer-spam-blocker/classes/idna_convert.php',
	'Thomkit\RefererAction' => 'system/modules/referer-spam-blocker/classes/RefererAction.php',
	'Thomkit\rsbCron'       => 'system/modules/referer-spam-blocker/classes/rsbCron.php',
));


/**
 * Register the templates
 */
TemplateLoader::addFiles(array
(
	'be_referer_spam' => 'system/modules/referer-spam-blocker/templates',
));

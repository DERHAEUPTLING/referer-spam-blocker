<?php

/**
 * Contao Open Source CMS
 *
 * Copyright (c) 2005-2015 Leo Feyer
 *
 * @package   referer-spam-blocker
 * @author    Frank Thonak
 * @license   LGPL
 * @copyright Martin Schwenzer (www.derhaeuptling.com)
 */
$GLOBALS['TL_MAINTENANCE'][] = 'RefererAction';


$GLOBALS['TL_CSS'][] = Environment::get('base').'/system/modules/referer-spam-blocker/assets/css/backend.css';


// hourly, daily, weekly und monthly sind Alternativen.
$GLOBALS['TL_CRON']['weekly'][]  = array('rsbCron', 'writeData');
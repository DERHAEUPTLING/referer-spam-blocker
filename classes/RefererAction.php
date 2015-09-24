<?php

/**
 * Contao Open Source CMS
 *
 * Copyright (c) 2005-2015 Leo Feyer
 *
 * @license LGPL
 */

namespace Thomkit;


/**
 * Maintenance module "referer spam".
 *
 * @author Leo Feyer <https://github.com/leofeyer>
 */
class RefererAction extends \Backend implements \executable
{

	/**
	 * Return true if the module is active
	 * @return boolean
	 */
	public function isActive()
	{
		return false; (in_array(\Input::get('rsb'),array('refererspamdelete','refererspam')));
	}


	/**
	 * Generate the module
	 * @return string
	 */
	public function run()
	{
		if (!\Config::get('enableSearch'))
		{
			return '';
		}

		$objTemplate = new \BackendTemplate('be_referer_spam');
		$objTemplate->isActive = false;
		$objTemplate->action = ampersand(\Environment::get('request'));
		$objTemplate->headline = 'Referer Spam Blocker';
		$objTemplate->submit1 = $GLOBALS['TL_LANG']['MSC']['referer-spam-blocker']['submit1'];
		$objTemplate->submit2 = $GLOBALS['TL_LANG']['MSC']['referer-spam-blocker']['submit2'];

		if(in_array(\Input::post('rsb'),array('refererspamdelete','refererspam')))
		{

			$rsb = new rsbCron;
			$objTemplate->message = $GLOBALS['TL_LANG']['MSC']['referer-spam-blocker'][$rsb->writeData()];

		//include('/../system/modules/refererspamblocker/classes/cron.php');
		}

		return $objTemplate->parse();
	}
}

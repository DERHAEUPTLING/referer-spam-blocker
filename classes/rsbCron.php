<?php

namespace Thomkit;


class rsbCron extends \Controller
{

	public function writeData()
	{

		global $objPage;

		if(\Input::post('rsb') == "refererspamdelete")// nur Block loeschen
		{
			if($file = $this->delReferer(true))
			{
				fclose($file);
				return 'delete_ok';
			}
		} else if((\Config::get('referer_active') || \Input::post('rsb') == "refererspam")) // aktiv oder manuell
		{
			// Datenquelle holen
			\Config::get('referer_source') == '' ? $dataURL = "https://raw.githubusercontent.com/piwik/referrer-spam-blacklist/master/spammers.txt" : $dataURL = \Config::get('referer_source');
			if($data = file_get_contents($dataURL))
			{
			// Kommentare entfernen
			// einzeilige Kommentare entfernen
				$data = preg_replace("/(\/\/.*)/", "", $data);
			// mehrzeilige Kommentare entfernen
				$data = preg_replace("/(\/\*.*\*\/)/sU", "", $data);
			// Array aufbereiten
				preg_match_all("/(^|\S)([^\s]+\.[^\s]+)(\S|$)/s", $data, $output_array);
				$dataSource = $output_array[0];
			}
			if(count($dataSource) > 0 && $file = $this->delReferer(false)) // Datenquelle und nicht nur loeschen
			{
			// Sonderzeichen umschreiben
				define('IDN_FALLBACK_VERSION',2008);
				$idn = new idna_convert(array('idn_version'=>IDN_FALLBACK_VERSION));
				for($i = 0; $i < count($dataSource); $i++)
				{
					$dataSource[$i] = $idn->encode($dataSource[$i]);
				}
			// Block einsetzen
				$refererBlock = "\n\n# referer-spam-blocker start
<IfModule mod_setenvif.c>
# Set spammers referral as spambot
SetEnvIfNoCase Referer ".implode(" spambot=yes
SetEnvIfNoCase Referer ",$dataSource)." spambot=yes
## add as many as you find

Order allow,deny
Allow from all
Deny from env=spambot
</IfModule>
# referer-spam-blocker end";
				if(fwrite($file, $refererBlock))
				{
					fclose($file);
					return 'write_ok';
				} else
				{
					return 'write_error';
				}
			}
		}
	}


	private function delReferer($onlyDel = false)
	{
		if($file = $this->openHtaccess($onlyDel))
		{
		// Block loeschen
			fclose($file);
			$tmp = file_get_contents(TL_ROOT . '/.htaccess');
			file_put_contents(TL_ROOT . '/.htaccess',preg_replace("/(\n{0,2}# referer-spam-blocker start.*# referer-spam-blocker end)/s", "", $tmp));
			return fopen(TL_ROOT . '/.htaccess', "a");
		}
		return false;
	}

	private function openHtaccess($onlyDel = true)
	{
		if(file_exists(TL_ROOT . '/.htaccess')) // htaccess vorhanden
		{
			if(is_writeable(TL_ROOT . '/.htaccess'))
			{
			// htaccess oeffnen

			return $fh = fopen(TL_ROOT . '/.htaccess', 'a');

			} else
			{
				return false;
			}
		} else if(!$onlyDel)
		{
		// htaccess erstellen
			return fopen(TL_ROOT . '/.htaccess', "c+");
		}
	}
}
?>
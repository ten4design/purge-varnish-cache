<?php
namespace Craft;

class PurgeVarnishCachePlugin extends BasePlugin
{

	public function getName()
	{
		return Craft::t('Purge Varnish Cache');
	}

	public function getVersion()
	{
		return '1.0';
	}

	public function getDeveloper()
	{
		return 'Ten4 Design Ltd';
	}

	public function getDeveloperUrl()
	{
		return 'http://ten4design.co.uk/';
	}

	public function hasCpSection()
	{
		return true;
	}

	public function init()
	{
		craft()->on('elements.onSaveElement', function(Event $event)
		{
			// If an entry has related fields, they might get saved too, causing multiple purge requests.
			// A full-site purge only needs to happen once per request, so we should ensure that.
			static $purge_complete = false;
			if ($purge_complete)
			{
				return;
			}
			craft()->purgeVarnishCache->purgeAll();
			// Mark the purge complete.
			$purge_complete = true;
		});
	}

}

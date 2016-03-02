<?php
namespace Craft;

class PurgeVarnishCacheService extends BaseApplicationComponent
{

	public static function purgeAll()
	{
		$env = craft()->config->get('environmentVariables');
		if (!array_key_exists('varnishUrls', $env))
		{
			return;
		}
		$urlsToClear = $env['varnishUrls'];
		// Send a new PURGE HTTP request to a wildcard URL that matches everything.
		$client = new \Guzzle\Http\Client();
		foreach ($urlsToClear as $url)
		{
			$wildcardUrl = trim($url, '/') . '/.*';
			$request = $client->createRequest('PURGE', $wildcardUrl);
			try
			{
				$response = $request->send();
			}
			catch (\Guzzle\Http\Exception\ClientErrorResponseException $e) {}
		}
	}

}

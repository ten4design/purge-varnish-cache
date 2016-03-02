
Place these files inside a directory called `purgevarnishcache` inside your plugins folder.

Specify the URLs or IPs to clear in your Craft config (trailing slash optional):

```php
'environmentVariables' => array(
	// ...
	'varnishUrls' => array(
		'http://www.cool-site.com',
		'http://100.56.100.56',
		'http://56.100.56.100'
	)
)
```

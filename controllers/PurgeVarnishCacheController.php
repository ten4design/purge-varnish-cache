<?php
namespace Craft;

class PurgeVarnishCacheController extends BaseController
{

	public function actionPurgeAll()
	{
		try
		{
			craft()->purgeVarnishCache->purgeAll();
			craft()->userSession->setNotice(Craft::t('Cache purge successful'));
		}
		catch(Exception $e)
		{
			craft()->userSession->setError($e->getMessage());
		}
		$this->redirect('purgevarnishcache');
	}

}
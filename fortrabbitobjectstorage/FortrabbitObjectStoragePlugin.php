<?php namespace Craft;

/**
 * @author    Oliver Stark <os@fortrabbit.com>
 * @license   http://buildwithcraft.com/license Craft License Agreement
 */

/**
 * Class FortrabbitObjectStoragePlugin
 * @package Craft
 */
class FortrabbitObjectStoragePlugin extends BasePlugin
{
    /**
     * @return null|string
     */
    public function getName()
    {
        return Craft::t('Support for fortrabbit Object Storage');
    }

    /**
     * @return string
     */
    public function getVersion()
    {
        return '0.1';
    }

    /**
     * @return string
     */
    public function getDeveloper()
    {
        return 'Oliver Stark';
    }

    /**
     * @return string
     */
    public function getDeveloperUrl()
    {
        return 'https://www.fortrabbit.com';
    }

    /**
     * @return bool
     */
    public function hasCpSection()
    {
        return false;
    }


    /**
     * @throws \Exception
     */
    public function init()
    {
        // Use a modified S3 class
        require __DIR__ . '/S3.php';

        // Catch the getS3Buckets AJAX call action and return custom response
        if (craft()->request->pathInfo == 'admin/actions/assetSources/getS3Buckets') {

            $region       = craft()->config->get('region', 'fortrabbitobjectstorage');
            $keyId        = craft()->request->getRequiredPost('keyId');
            $bucketList[] = [
                'bucket'    => $keyId,
                'location'  => $region,
                'urlPrefix' => 'https://' . $keyId . '.objects.frb.io/'
            ];

            return (new AssetSourcesController(''))->returnJson($bucketList);
        }

    }

}

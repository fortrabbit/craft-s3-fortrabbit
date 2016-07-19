# Craft Plugin for the fortrabbit Object Storage

Plugin changes the default API endpoint of Craft's S3-AssetSource.


## Quickstart

1. Copy the `fortrabbitobjectstorage/` folder to your `craft/plugins/` folder.
2. Go to Settings > Plugins from your Craft control panel and install the "Support for fortrabbit Object Storage" plugin.
3. Go to Settings > Assets and click the "New asset source" button.
4. Select a *Amazon S3*
5. Enter your *Access Key ID (KEY)* and *Secret Access Key (SECRET)*
6. Hit *Refesh* to get the bucket
7. Save

## Credentials

Use this SSH command to get the Object Storage credentials for your App:

Schema: `ssh git@deploy.{region}.frbit.com secrets {your-app} object_storage`

EU: `ssh git@deploy.eu2.frbit.com secrets {your-app} object_storage`

US: `ssh git@deploy.us1.frbit.com secrets {your-app} object_storage`


## API Endpoint

Per default the plugin uses the API endpoint of fortrabbit's EU region. If your App runs in the US region, copy `fortrabbitobjectstorage/config.php` to `craft/config/fortrabbitobjectstorage.php` and change the endpoint.

## Hack Craft

Unfortunately with resource requests no plugin get's loaded. This means the modified S3 client we provide is not used in any case. Here is a way to fix it:

Include our modified S3 client very early, e.g. at the top in your `config/general.php`, like so ` 	require_once('../craft/plugins/fortrabbitobjectstorage/S3.php');`


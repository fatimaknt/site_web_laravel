<?php


namespace App\Helpers;

use App\Models\Configuration;
use PSpell\Config;

class ConfigHelper
{

    public static function getAppName()
    {
        $appName = Configuration::where('type', 'APP_NAME')->value('value');
        config(['app.name' => $appName]);
        return $appName;
    }

}
?>

<?php

namespace Album;

/**
 * The configuration provider for the App module
 *
 * @see https://docs.zendframework.com/zend-component-installer/
 */
use Zend\Stdlib\ArrayUtils;
class ConfigProvider
{
    /**
     * Returns the configuration array
     * @return array
     */
    public function __invoke()
    {
        return $this->getConfig();
    }


    public function getConfig()
    {
        $config = array();
        $configFiles = array(
            include __DIR__ . '/../config/module.config.php',
            include __DIR__ . '/../config/app.forms.php',
        );

        foreach ($configFiles as $file) {
            $config = ArrayUtils::merge($config, $file);
        }

        return $config;
    }
}

<?php

class Config
{
    private $oConfig;

    public function __construct($fileConfig = null)
    {
        if ($fileConfig) {
            if (is_object($oConfig = json_decode(file_get_contents($fileConfig)))) {
                $this->oConfig = $oConfig;
                $_SESSION['oConfig'] = $this;
            }
        }
    }

    public function getConfig()
    {
        return $this->oConfig;
    }

}
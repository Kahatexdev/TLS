<?php

namespace Config;

use CodeIgniter\Config\BaseConfig;

class Redis extends BaseConfig
{
    public $host = '127.0.0.1';
    public $port = 6379;
    public $timeout = 0.0;
    public $reserved = null;
    public $retry_interval = 0;
    public $read_timeout = 0.0;
    public $persistent = false;
}

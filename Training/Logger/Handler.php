<?php

declare(strict_types=1);

namespace Convert\Training\Logger;

use Magento\Framework\Logger\Handler\System;
use Monolog\Logger;

class Handler extends System
{
    protected $fileName = '/var/log/convert_training.log';
    protected $loggerType = Logger::INFO;
}

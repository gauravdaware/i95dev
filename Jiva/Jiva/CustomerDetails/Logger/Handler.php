<?php 

namespace Jiva\CustomerDetails\Logger;

class Handler extends \Magento\Framework\Logger\Handler\Base
{

    protected $loggerType = Logger::INFO;

    protected $fileName = '/var/log/customfile.log';
}
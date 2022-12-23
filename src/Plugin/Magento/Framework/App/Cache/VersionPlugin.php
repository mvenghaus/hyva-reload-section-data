<?php

declare(strict_types=1);

namespace MVenghaus\HyvaReloadSectionData\Plugin\Magento\Framework\App\Cache;

use Magento\Framework\App\PageCache\Version;
use Magento\Framework\App\Request\Http as HttpRequest;

class VersionPlugin
{
    public function __construct(
        private readonly HttpRequest $httpRequest
    ) {
    }

    /**
     * @SuppressWarnings(PHPMD.UnusedFormalParameter)
     */
    public function aroundProcess(Version $subject, callable $proceed): void
    {
        if ($this->httpRequest->isPost()) {
            if ($this->httpRequest->isAjax() ||
                $this->httpRequest->getHeader('content-type') === 'application/json'
            ) {
                return;
            }
        }

        $proceed();
    }
}

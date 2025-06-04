<?php

namespace Tourze\WechatWorkExternalContactModel;

use Tourze\WechatWorkContracts\CorpInterface;

interface ExternalUserLoaderInterface
{
    /**
     * 根据UnionId和公司查找外部联系人
     */
    public function loadByUnionIdAndCorp(string $unionId, CorpInterface $corp): ?ExternalContactInterface;
}

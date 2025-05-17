<?php

namespace Tourze\WechatWorkExternalContactModel;

interface ExternalContactInterface
{
    /**
     * 外部联系人的userid
     *
     * @return string|null
     */
    public function getExternalUserId(): ?string;
}

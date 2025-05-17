<?php

namespace Tourze\WechatWorkExternalContactModel;

/**
 * @see https://developer.work.weixin.qq.com/document/path/91670
 */
enum ContactType: int
{
    // 表示该外部联系人是微信用户
    case WECHAT = 1;

    // 表示该外部联系人是企业微信用户
    case WEWORK = 2;
}

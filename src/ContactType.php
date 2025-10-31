<?php

namespace Tourze\WechatWorkExternalContactModel;

use Tourze\EnumExtra\Itemable;
use Tourze\EnumExtra\ItemTrait;
use Tourze\EnumExtra\Labelable;
use Tourze\EnumExtra\Selectable;
use Tourze\EnumExtra\SelectTrait;

/**
 * @see https://developer.work.weixin.qq.com/document/path/91670
 */
enum ContactType: int implements Labelable, Itemable, Selectable
{
    use ItemTrait;
    use SelectTrait;

    // 表示该外部联系人是微信用户
    case WECHAT = 1;

    // 表示该外部联系人是企业微信用户
    case WEWORK = 2;

    public function getLabel(): string
    {
        return match ($this) {
            self::WECHAT => '微信用户',
            self::WEWORK => '企业微信用户',
        };
    }
}

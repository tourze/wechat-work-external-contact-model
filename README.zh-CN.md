# Wechat Work External Contact Model

[English](README.md) | [中文](README.zh-CN.md)

[![Latest Version](https://img.shields.io/packagist/v/tourze/wechat-work-external-contact-model.svg?style=flat-square)](https://packagist.org/packages/tourze/wechat-work-external-contact-model)
[![Total Downloads](https://img.shields.io/packagist/dt/tourze/wechat-work-external-contact-model.svg?style=flat-square)](https://packagist.org/packages/tourze/wechat-work-external-contact-model)
[![License](https://img.shields.io/badge/license-MIT-brightgreen.svg?style=flat-square)](LICENSE)
[![PHP Version](https://img.shields.io/badge/php-%5E8.1-blue.svg?style=flat-square)]
[![Build Status](https://img.shields.io/badge/build-passing-brightgreen.svg?style=flat-square)](#)
[![Code Coverage](https://img.shields.io/badge/coverage-90%25-green.svg?style=flat-square)](#)

企业微信外部联系人定义 - 提供企业微信外部联系人的接口定义和类型枚举。

## 安装

```bash
composer require tourze/wechat-work-external-contact-model
```

## 快速开始

### 联系人类型枚举

```php
<?php

use Tourze\WechatWorkExternalContactModel\ContactType;

// 获取联系人类型标签
echo ContactType::WECHAT->getLabel(); // '微信用户'
echo ContactType::WEWORK->getLabel(); // '企业微信用户'

// 获取所有联系人类型用于选择框
$options = ContactType::getSelectOptions();
```

### 外部联系人接口

```php
<?php

use Tourze\WechatWorkExternalContactModel\ExternalContactInterface;

class MyExternalContact implements ExternalContactInterface
{
    public function getExternalUserId(): ?string
    {
        // 返回外部用户 ID
        return $this->externalUserId;
    }

    public function getUnionId(): ?string
    {
        // 返回 union ID
        return $this->unionId;
    }

    public function getNickname(): ?string
    {
        // 返回昵称
        return $this->nickname;
    }

    public function getAvatar(): ?string
    {
        // 返回头像 URL
        return $this->avatar;
    }
}
```

### 外部用户加载器接口

```php
<?php

use Tourze\WechatWorkExternalContactModel\ExternalUserLoaderInterface;
use Tourze\WechatWorkContracts\CorpInterface;

class MyExternalUserLoader implements ExternalUserLoaderInterface
{
    public function loadByUnionIdAndCorp(string $unionId, CorpInterface $corp): ?ExternalContactInterface
    {
        // 根据 union ID 和企业加载外部联系人
        return $this->findExternalContact($unionId, $corp);
    }
}
```

## 组件

### ContactType 枚举

定义外部联系人类型：
- `WECHAT` (1): 微信用户
- `WEWORK` (2): 企业微信用户

### ExternalContactInterface

定义外部联系人实体的契约，包含方法：
- `getExternalUserId()`: 获取外部用户 ID
- `getUnionId()`: 获取 union ID
- `getNickname()`: 获取昵称
- `getAvatar()`: 获取头像 URL

### ExternalUserLoaderInterface

定义加载外部联系人的契约：
- `loadByUnionIdAndCorp()`: 根据 union ID 和企业加载

## 依赖

- PHP 8.1+
- `tourze/enum-extra`: 增强的枚举功能
- `tourze/wechat-work-contracts`: 企业微信合约

## 参考文档

- [企业微信外部联系人 API](https://developer.work.weixin.qq.com/document/path/91670)

## 许可证

MIT

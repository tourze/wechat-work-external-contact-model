# Wechat Work External Contact Model

[English](README.md) | [中文](README.zh-CN.md)

[![Latest Version](https://img.shields.io/packagist/v/tourze/wechat-work-external-contact-model.svg?style=flat-square)](https://packagist.org/packages/tourze/wechat-work-external-contact-model)
[![Total Downloads](https://img.shields.io/packagist/dt/tourze/wechat-work-external-contact-model.svg?style=flat-square)](https://packagist.org/packages/tourze/wechat-work-external-contact-model)
[![License](https://img.shields.io/badge/license-MIT-brightgreen.svg?style=flat-square)](LICENSE)
[![PHP Version](https://img.shields.io/badge/php-%5E8.1-blue.svg?style=flat-square)]
[![Build Status](https://img.shields.io/badge/build-passing-brightgreen.svg?style=flat-square)](#)
[![Code Coverage](https://img.shields.io/badge/coverage-90%25-green.svg?style=flat-square)](#)

A PHP library that provides interface definitions and type enumerations for WeChat Work (Enterprise WeChat) external contacts.

## Installation

```bash
composer require tourze/wechat-work-external-contact-model
```

## Quick Start

### Contact Type Enumeration

```php
<?php

use Tourze\WechatWorkExternalContactModel\ContactType;

// Get contact type label
echo ContactType::WECHAT->getLabel(); // 'WeChat User'
echo ContactType::WEWORK->getLabel(); // 'WeChat Work User'

// Get all contact types for select options
$options = ContactType::getSelectOptions();
```

### External Contact Interface

```php
<?php

use Tourze\WechatWorkExternalContactModel\ExternalContactInterface;

class MyExternalContact implements ExternalContactInterface
{
    public function getExternalUserId(): ?string
    {
        // Return the external user ID
        return $this->externalUserId;
    }

    public function getUnionId(): ?string
    {
        // Return the union ID
        return $this->unionId;
    }

    public function getNickname(): ?string
    {
        // Return the nickname
        return $this->nickname;
    }

    public function getAvatar(): ?string
    {
        // Return the avatar URL
        return $this->avatar;
    }
}
```

### External User Loader Interface

```php
<?php

use Tourze\WechatWorkExternalContactModel\ExternalUserLoaderInterface;
use Tourze\WechatWorkContracts\CorpInterface;

class MyExternalUserLoader implements ExternalUserLoaderInterface
{
    public function loadByUnionIdAndCorp(string $unionId, CorpInterface $corp): ?ExternalContactInterface
    {
        // Load external contact by union ID and corporation
        return $this->findExternalContact($unionId, $corp);
    }
}
```

## Components

### ContactType Enum

Defines the type of external contact:
- `WECHAT` (1): WeChat user
- `WEWORK` (2): WeChat Work user

### ExternalContactInterface

Defines the contract for external contact entities with methods:
- `getExternalUserId()`: Get external user ID
- `getUnionId()`: Get union ID
- `getNickname()`: Get nickname
- `getAvatar()`: Get avatar URL

### ExternalUserLoaderInterface

Defines the contract for loading external contacts:
- `loadByUnionIdAndCorp()`: Load by union ID and corporation

## Dependencies

- PHP 8.1+
- `tourze/enum-extra`: Enhanced enum functionality
- `tourze/wechat-work-contracts`: WeChat Work contracts

## Reference

- [WeChat Work External Contact API](https://developer.work.weixin.qq.com/document/path/91670)

## License

MIT
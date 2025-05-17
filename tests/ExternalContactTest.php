<?php

namespace Tourze\WechatWorkExternalContactModel\Tests;

use PHPUnit\Framework\TestCase;
use Tourze\WechatWorkExternalContactModel\ExternalContactInterface;

class ExternalContactTest extends TestCase
{
    /**
     * 创建一个实现ExternalContactInterface的测试类
     */
    private function createExternalContactImplementation(
        ?string $externalUserId = null,
        ?string $unionId = null,
        ?string $nickname = null,
        ?string $avatar = null
    ): ExternalContactInterface {
        return new class($externalUserId, $unionId, $nickname, $avatar) implements ExternalContactInterface {
            public function __construct(
                private readonly ?string $externalUserId,
                private readonly ?string $unionId,
                private readonly ?string $nickname,
                private readonly ?string $avatar
            ) {
            }

            public function getExternalUserId(): ?string
            {
                return $this->externalUserId;
            }

            public function getUnionId(): ?string
            {
                return $this->unionId;
            }

            public function getNickname(): ?string
            {
                return $this->nickname;
            }

            public function getAvatar(): ?string
            {
                return $this->avatar;
            }
        };
    }

    /**
     * 测试正常情况下的外部联系人接口实现
     */
    public function testExternalContactWithValidData()
    {
        $externalUserId = 'wmqfaVDAAAA1234567890';
        $unionId = 'unionid_1234567890';
        $nickname = '张三';
        $avatar = 'https://example.com/avatar.jpg';

        $externalContact = $this->createExternalContactImplementation(
            $externalUserId,
            $unionId,
            $nickname,
            $avatar
        );

        $this->assertSame($externalUserId, $externalContact->getExternalUserId());
        $this->assertSame($unionId, $externalContact->getUnionId());
        $this->assertSame($nickname, $externalContact->getNickname());
        $this->assertSame($avatar, $externalContact->getAvatar());
    }

    /**
     * 测试外部联系人接口实现返回空值
     */
    public function testExternalContactWithNullValues()
    {
        $externalContact = $this->createExternalContactImplementation();

        $this->assertNull($externalContact->getExternalUserId());
        $this->assertNull($externalContact->getUnionId());
        $this->assertNull($externalContact->getNickname());
        $this->assertNull($externalContact->getAvatar());
    }

    /**
     * 测试外部联系人接口实现部分字段为空
     */
    public function testExternalContactWithPartialNullValues()
    {
        $externalUserId = 'wmqfaVDAAAA1234567890';
        $externalContact = $this->createExternalContactImplementation($externalUserId);

        $this->assertSame($externalUserId, $externalContact->getExternalUserId());
        $this->assertNull($externalContact->getUnionId());
        $this->assertNull($externalContact->getNickname());
        $this->assertNull($externalContact->getAvatar());
    }

    /**
     * 测试特殊字符处理
     */
    public function testExternalContactWithSpecialCharacters()
    {
        $externalUserId = 'wmqfaVDAAAA1234567890';
        $unionId = 'unionid_1234567890';
        $nickname = '张三（测试）';
        $avatar = 'https://example.com/avatar.jpg?param=value&another=test';

        $externalContact = $this->createExternalContactImplementation(
            $externalUserId,
            $unionId,
            $nickname,
            $avatar
        );

        $this->assertSame($externalUserId, $externalContact->getExternalUserId());
        $this->assertSame($unionId, $externalContact->getUnionId());
        $this->assertSame($nickname, $externalContact->getNickname());
        $this->assertSame($avatar, $externalContact->getAvatar());
    }

    /**
     * 测试边界情况：空字符串
     */
    public function testExternalContactWithEmptyStrings()
    {
        $externalContact = $this->createExternalContactImplementation('', '', '', '');

        $this->assertSame('', $externalContact->getExternalUserId());
        $this->assertSame('', $externalContact->getUnionId());
        $this->assertSame('', $externalContact->getNickname());
        $this->assertSame('', $externalContact->getAvatar());
        
        // 空字符串和null是不同的
        $this->assertNotNull($externalContact->getExternalUserId());
        $this->assertNotNull($externalContact->getUnionId());
        $this->assertNotNull($externalContact->getNickname());
        $this->assertNotNull($externalContact->getAvatar());
    }
} 
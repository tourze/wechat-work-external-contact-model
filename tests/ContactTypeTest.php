<?php

namespace Tourze\WechatWorkExternalContactModel\Tests;

use PHPUnit\Framework\TestCase;
use Tourze\WechatWorkExternalContactModel\ContactType;

class ContactTypeTest extends TestCase
{
    /**
     * 测试枚举值是否正确定义
     */
    public function testEnumValues()
    {
        $this->assertSame(1, ContactType::WECHAT->value);
        $this->assertSame(2, ContactType::WEWORK->value);
    }

    /**
     * 测试getLabel方法返回正确的标签
     */
    public function testGetLabel()
    {
        $this->assertSame('微信用户', ContactType::WECHAT->getLabel());
        $this->assertSame('企业微信用户', ContactType::WEWORK->getLabel());
    }

    /**
     * 测试toSelectItem方法返回正确的选项结构
     */
    public function testToSelectItem()
    {
        $expected = [
            'label' => '微信用户',
            'text' => '微信用户',
            'value' => 1,
            'name' => '微信用户',
        ];
        $this->assertSame($expected, ContactType::WECHAT->toSelectItem());

        $expected = [
            'label' => '企业微信用户',
            'text' => '企业微信用户',
            'value' => 2,
            'name' => '企业微信用户',
        ];
        $this->assertSame($expected, ContactType::WEWORK->toSelectItem());
    }

    /**
     * 测试toArray方法返回正确的数组结构
     */
    public function testToArray()
    {
        $expected = [
            'value' => 1,
            'label' => '微信用户',
        ];
        $this->assertSame($expected, ContactType::WECHAT->toArray());

        $expected = [
            'value' => 2,
            'label' => '企业微信用户',
        ];
        $this->assertSame($expected, ContactType::WEWORK->toArray());
    }

    /**
     * 测试genOptions方法返回所有选项
     */
    public function testGenOptions()
    {
        $options = ContactType::genOptions();
        $this->assertCount(2, $options);
        
        // 验证选项内容
        $this->assertSame([
            [
                'label' => '微信用户',
                'text' => '微信用户',
                'value' => 1,
                'name' => '微信用户',
            ],
            [
                'label' => '企业微信用户',
                'text' => '企业微信用户',
                'value' => 2,
                'name' => '企业微信用户',
            ]
        ], $options);
    }

    /**
     * 测试genOptions方法在环境变量控制下的行为
     */
    public function testGenOptionsWithEnvControl()
    {
        // 保存原始环境变量
        $originalEnv = $_ENV;

        try {
            // 设置环境变量禁用WECHAT选项
            $_ENV['enum-display:' . ContactType::class . '-1'] = false;
            
            $options = ContactType::genOptions();
            $this->assertCount(1, $options);
            $this->assertSame(2, $options[0]['value']);
            
            // 设置环境变量禁用所有选项
            $_ENV['enum-display:' . ContactType::class . '-1'] = false;
            $_ENV['enum-display:' . ContactType::class . '-2'] = false;
            
            $options = ContactType::genOptions();
            $this->assertEmpty($options);
        } finally {
            // 恢复原始环境变量
            $_ENV = $originalEnv;
        }
    }
} 
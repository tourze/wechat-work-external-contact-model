<?php

namespace Tourze\WechatWorkExternalContactModel\Tests;

use PHPUnit\Framework\Attributes\CoversClass;
use PHPUnit\Framework\TestCase;
use Tourze\WechatWorkContracts\CorpInterface;
use Tourze\WechatWorkExternalContactModel\ExternalContactInterface;
use Tourze\WechatWorkExternalContactModel\ExternalUserLoaderInterface;

/**
 * @internal
 */
#[CoversClass(ExternalUserLoaderInterface::class)]
final class ExternalUserLoaderTest extends TestCase
{
    /**
     * 创建一个实现ExternalUserLoaderInterface的测试类
     */
    private function createExternalUserLoaderImplementation(
        ?ExternalContactInterface $returnValue = null,
    ): ExternalUserLoaderInterface {
        return new class ($returnValue) implements ExternalUserLoaderInterface {
            public function __construct(
                private readonly ?ExternalContactInterface $returnValue,
            ) {
            }

            public function loadByUnionIdAndCorp(string $unionId, CorpInterface $corp): ?ExternalContactInterface
            {
                return $this->returnValue;
            }
        };
    }

    /**
     * 创建一个Mock的CorpInterface
     */
    private function createCorpMock(): CorpInterface
    {
        return $this->createMock(CorpInterface::class);
    }

    /**
     * 创建一个Mock的ExternalContactInterface
     */
    private function createExternalContactMock(): ExternalContactInterface
    {
        return $this->createMock(ExternalContactInterface::class);
    }

    /**
     * 测试正常情况下的外部用户加载器实现
     */
    public function testLoadByUnionIdAndCorpWithValidData(): void
    {
        $unionId = 'unionid_1234567890';
        $corp = $this->createCorpMock();
        $expectedContact = $this->createExternalContactMock();

        $loader = $this->createExternalUserLoaderImplementation($expectedContact);
        $result = $loader->loadByUnionIdAndCorp($unionId, $corp);

        $this->assertSame($expectedContact, $result);
    }

    /**
     * 测试当找不到外部联系人时返回null
     */
    public function testLoadByUnionIdAndCorpReturnsNull(): void
    {
        $unionId = 'nonexistent_unionid';
        $corp = $this->createCorpMock();

        $loader = $this->createExternalUserLoaderImplementation(null);
        $result = $loader->loadByUnionIdAndCorp($unionId, $corp);

        $this->assertNull($result);
    }

    /**
     * 测试边界情况：空字符串unionId
     */
    public function testLoadByUnionIdAndCorpWithEmptyUnionId(): void
    {
        $unionId = '';
        $corp = $this->createCorpMock();

        $loader = $this->createExternalUserLoaderImplementation(null);
        $result = $loader->loadByUnionIdAndCorp($unionId, $corp);

        $this->assertNull($result);
    }

    /**
     * 测试接口方法签名的正确性
     */
    public function testInterfaceMethodSignature(): void
    {
        $reflection = new \ReflectionClass(ExternalUserLoaderInterface::class);
        $method = $reflection->getMethod('loadByUnionIdAndCorp');

        // 检查方法是否存在
        $this->assertTrue($method->isPublic());

        // 检查参数数量
        $this->assertSame(2, $method->getNumberOfParameters());

        // 检查参数类型
        $parameters = $method->getParameters();
        $this->assertSame('unionId', $parameters[0]->getName());
        $firstParamType = $parameters[0]->getType();
        $this->assertInstanceOf(\ReflectionNamedType::class, $firstParamType);
        $this->assertSame('string', $firstParamType->getName());

        $this->assertSame('corp', $parameters[1]->getName());
        $secondParamType = $parameters[1]->getType();
        $this->assertInstanceOf(\ReflectionNamedType::class, $secondParamType);
        $this->assertSame(CorpInterface::class, $secondParamType->getName());

        // 检查返回类型 - nullable类型在反射中表现为ReflectionNamedType
        $returnType = $method->getReturnType();
        $this->assertInstanceOf(\ReflectionNamedType::class, $returnType);
        $this->assertTrue($returnType->allowsNull());
        $this->assertSame(ExternalContactInterface::class, $returnType->getName());
    }
}

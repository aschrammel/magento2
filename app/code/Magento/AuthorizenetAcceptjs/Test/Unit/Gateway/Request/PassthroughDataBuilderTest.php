<?php
/**
 * Copyright © Magento, Inc. All rights reserved.
 * See COPYING.txt for license details.
 */
declare(strict_types=1);

namespace Magento\AuthorizenetAcceptjs\Test\Unit\Gateway\Request;

use Magento\AuthorizenetAcceptjs\Gateway\Request\PassthroughDataBuilder;
use Magento\AuthorizenetAcceptjs\Model\PassthroughDataObject;
use PHPUnit\Framework\TestCase;

/**
 * Test for Magento\AuthorizenetAcceptjs\Gateway\Request\PassthroughDataBuilder
 */
class PassthroughDataBuilderTest extends TestCase
{
    /**
     * @return void
     */
    public function testBuild()
    {
        $passthroughData = new PassthroughDataObject([
            'foo' => 'bar',
            'baz' => 'bash'
        ]);
        $builder = new PassthroughDataBuilder($passthroughData);

        $expected = [
            'transactionRequest' => [
                'userFields' => [
                    'userField' => [
                        [
                            'name' => 'foo',
                            'value' => 'bar',
                        ],
                        [
                            'name' => 'baz',
                            'value' => 'bash',
                        ],
                    ],
                ],
            ],
        ];

        $this->assertEquals($expected, $builder->build([]));
    }

    /**
     * @return void
     */
    public function testBuildWithNoData()
    {
        $passthroughData = new PassthroughDataObject();
        $builder = new PassthroughDataBuilder($passthroughData);
        $expected = [];

        $this->assertEquals($expected, $builder->build([]));
    }
}

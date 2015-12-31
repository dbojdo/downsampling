<?php
/**
 * LargestTriangleThreeBucketsDownSamplerTest.php
 *
 * @author dbojdo - Daniel Bojdo <daniel.bojdo@dxi.eu>
 * Created on Mar 16, 2015, 10:09
 * Copyright (C) DXI Ltd
 */

namespace Webit\DownSampling\Tests\DownSampler;

use Webit\DownSampling\DownSampler\LargestTriangleThreeBucketsDownSampler;

/**
 * Class LargestTriangleThreeBucketsDownSamplerTest
 * @package Webit\DownSampling\Tests\DownSampler
 */
class LargestTriangleThreeBucketsDownSamplerTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @test
     * @param array $input
     * @param int $threshold
     * @param array $expected
     * @dataProvider getData
     */
    public function shouldReturnExpectedElementsNumber(array $input, $threshold, array $expected)
    {
        $sampler = new LargestTriangleThreeBucketsDownSampler();
        $sampled = $sampler->sampleDown($input, $threshold);

        $this->assertEquals($expected, $sampled);
    }

    /**
     * @return array
     */
    public function getData()
    {
        return array(
            array(
                require(__DIR__ .'/../Fixtures/input.php'),
                400,
                require(__DIR__.'/../Fixtures/sampled_400.php')
            ),
            array(
                array_values(require(__DIR__ .'/../Fixtures/input.php')),
                400,
                array_values(require(__DIR__.'/../Fixtures/sampled_400.php'))
            )
        );
    }
}

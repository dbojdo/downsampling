<?php
/**
 * LargestTriangleThreeBucketsDownSamplerTest.php
 *
 * @author dbojdo - Daniel Bojdo <daniel.bojdo@dxi.eu>
 * Created on Mar 16, 2015, 10:09
 * Copyright (C) DXI Ltd
 */

namespace Webit\DownSampling\DownSampler;

use PHPUnit\Framework\TestCase;

class LargestTriangleThreeBucketsDownSamplerTest extends TestCase
{
    /**
     * @test
     * @param array $input
     * @param int $threshold
     * @param array $expected
     * @dataProvider getData
     */
    public function shouldReturnExpectedElementsNumber(array $input, int $threshold, array $expected)
    {
        $sampler = new LargestTriangleThreeBucketsDownSampler();
        $sampled = $sampler->sampleDown($input, $threshold);

        $this->assertEquals($expected, $sampled);
    }

    /**
     * @return array
     */
    public function getData(): array
    {
        $input = require(__DIR__ .'/../Fixtures/input.php');
        $sampled400 = require(__DIR__.'/../Fixtures/sampled_400.php');

        return [
            [
                $input,
                400,
                $sampled400
            ]
        ];
    }
}

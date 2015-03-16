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
     * @param array $data
     * @param int $threshold
     * @param int $maxExpected
     * @dataProvider getData
     */
    public function shouldReturnExpectedElementsNumber(array $data, $threshold, $maxExpected)
    {
        $sampler = new LargestTriangleThreeBucketsDownSampler();
        $sampled = $sampler->sampleDown($data, $threshold);

        $this->assertGreaterThan(0, count($sampled));
        $this->assertLessThanOrEqual($maxExpected, count($sampled));
    }

    /**
     * @return array
     */
    public function getData()
    {
        return array(
            array($this->createSignal(500), 100, 100),
            array($this->createSignal(500), 600, 500)
        );
    }

    /**
     * @param int $length
     * @return array
     */
    private function createSignal($length = 500)
    {
        $signal = array();
        for ($i = 0; $i < $length; $i++) {
            $signal[] = mt_rand(-100, 100) / 10;
        }

        return $signal;
    }
}

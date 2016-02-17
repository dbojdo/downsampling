<?php
/**
 * File LargestTriangleThreeBucketsDownSamplerMultiDownSamplerTest.php
 * Created at: 2016-02-17 05-47
 *
 * @author Daniel Bojdo <daniel.bojdo@web-it.eu>
 */

namespace Webit\DownSampling\Tests\DownSampler;


use Webit\DownSampling\DownSampler\LargestTriangleThreeBucketsDownSampler;
use Webit\DownSampling\DownSampler\LargestTriangleThreeBucketsDownSamplerMultiDownSampler;
use Webit\DownSampling\DownSampler\MultiColumnDownSamplerContext;

class LargestTriangleThreeBucketsDownSamplerMultiDownSamplerTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @var LargestTriangleThreeBucketsDownSamplerMultiDownSampler
     */
    private $multiSampler;

    protected function setUp()
    {
        $this->multiSampler = new LargestTriangleThreeBucketsDownSamplerMultiDownSampler(
            new LargestTriangleThreeBucketsDownSampler()
        );
    }

    /**
     * @test
     * @dataProvider multiColumnData
     * @param array[] $data
     * @param int $threshold
     * @param mixed $xKey
     * @param mixed $yKeys
     * @param $expectedSampled
     */
    public function shouldSampleDownMultiColumnData($data, $threshold, $xKey, $yKeys, $expectedSampled)
    {
        $this->assertEquals(
            $expectedSampled,
            $this->multiSampler->sampleDown(
                $data,
                new MultiColumnDownSamplerContext($threshold, $yKeys, $xKey)
            )
        );
    }

    public function multiColumnData()
    {
        return array(
            array(
                include __DIR__.'/../Fixtures/input_multi.php',
                400,
                0,
                array(1, 2),
                include __DIR__.'/../Fixtures/sampled_multi_400.php'
            ),
            array(
                include __DIR__.'/../Fixtures/input_multi_assoc.php',
                400,
                'k1',
                array('k2', 'k3'),
                include __DIR__.'/../Fixtures/sampled_multi_assoc_400.php'
            ),
            array(
                include __DIR__.'/../Fixtures/input_multi_assoc.php',
                400,
                null,
                array('k2', 'k3'),
                include __DIR__.'/../Fixtures/sampled_multi_assoc_no_key_400.php'
            )
        );
    }
}

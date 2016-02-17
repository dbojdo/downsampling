<?php
/**
 * File LargestTriangleThreeBucketsDownSamplerMultiDownSampler.php
 * Created at: 2016-02-17 05-11
 *
 * @author Daniel Bojdo <daniel.bojdo@web-it.eu>
 */

namespace Webit\DownSampling\DownSampler;

class LargestTriangleThreeBucketsDownSamplerMultiDownSampler implements MultiColumnDownSampler
{
    /**
     * @var LargestTriangleThreeBucketsDownSampler
     */
    private $sampler;

    /**
     * LargestTriangleThreeBucketsDownSamplerMultiDownSampler constructor.
     * @param LargestTriangleThreeBucketsDownSampler $sampler
     */
    public function __construct(LargestTriangleThreeBucketsDownSampler $sampler = null)
    {
        $this->sampler = $sampler ?: new LargestTriangleThreeBucketsDownSampler();
    }

    /**
     * @param @param array[] $data (array of ["k1" => "key", "k2" => "value", "k3" => "value", ...] arrays)
     * @param MultiColumnDownSamplerContext $context
     * @return array[]
     */
    public function sampleDown(array $data, MultiColumnDownSamplerContext $context)
    {
        $sampledData = array();

        $xKeyCallback = $this->createXKeyPrepareCallback($context->xKey());
        foreach ($context->yKeys() as $key) {
            $keyData = $this->prepareData($data, $key, $xKeyCallback);

            $sampledColumn = $this->sampler->sampleDown($keyData, $context->threshold());

            foreach ($sampledColumn as $i => $sampledRow) {
                if (! isset($sampledData[$i])) {
                    $sampledData[$i] = $data[$sampledRow[0]];
                }

                $sampledData[$i][$key] = $sampledRow[1];
            }
        }

        return $sampledData;
    }

    /**
     * @param array $data
     * @param mixed $yKey
     * @return array
     */
    private function prepareData($data, $yKey)
    {
        $prepared = array();
        foreach ($data as $i => $row) {
            $prepared[] = array(
                $i,
                $row[$yKey]
            );
        }

        return $prepared;
    }

    /**
     * @param string $xKey
     * @return \Closure
     */
    private function createXKeyPrepareCallback($xKey)
    {
        if ($xKey !== null) {
            return function ($row, $i) use ($xKey) {
                return $row[$xKey];
            };
        }

        return function ($row, $i) {
            return $i;
        };
    }

    /**
     * @param string $xKey
     * @return \Closure
     */
    private function createMergeCallback($xKey, $yKey)
    {
        if (! is_null($xKey)) {
            return function (array $sampledData, $sampledColumn, $i) use ($xKey, $yKey) {
                $sampledData[$i][$xKey] = $sampledColumn[$i][0];
                $sampledData[$i][$yKey] = $sampledColumn[$i][1];

                return $sampledData;
            };
        }

        return function (array $sampledData, $sampledColumn, $i) use ($yKey) {
            $sampledData[$i][$yKey] = $sampledColumn[$i][1];
            return $sampledData;
        };
    }

    /**
     * @param array $sampledData
     * @param array $sampledColumn
     * @param $mergeCallback
     */
    private function mergeSampledData(array &$sampledData, array $sampledColumn, $mergeCallback)
    {
        for ($i = 0; $i < count($sampledColumn); $i++) {
            $sampledData = call_user_func($mergeCallback, $sampledData, $sampledColumn, $i);
        }
    }
}

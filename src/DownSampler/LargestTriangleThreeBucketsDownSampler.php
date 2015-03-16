<?php
/**
 * LargestTriangleThreeBucketsDownSampler.php
 *
 * @author dbojdo - Daniel Bojdo <daniel.bojdo@web-it.eu>
 * Created on Mar 16, 2015, 10:05
 */

namespace Webit\DownSampling\DownSampler;

/**
 * Class LargestTriangleThreeBucketsDownSampler
 * @package Webit\DownSampling\DownSampler
 */
class LargestTriangleThreeBucketsDownSampler implements DownSampler
{

    /**
     * @param array $data
     * @param int $threshold
     * @return array
     */
    public function sampleDown(array $data, $threshold)
    {
        $threshold = (int) $threshold;
        $dataLength = count($data);
        if ($threshold >= $dataLength || $threshold === 0) {
            return $data; // Nothing to do
        }

        $sampled = array();
        $sampledIndex = 0;

        // Bucket size. Leave room for start and end data points
        $every = ($dataLength - 2) / ($threshold - 2);

        $a = 0;  // Initially a is the first point in the triangle
        $maxAreaPoint = null;
        $maxArea = null;
        $area = null;
        $nextA = null;

        $sampled[$sampledIndex++] = $data[$a]; // Always add the first point

        for ($i = 0; $i < $threshold - 2; $i++) {

            // Calculate point average for next bucket (containing c)
            $avgX = 0;
            $avgY = 0;
            $avgRangeStart = floor(($i + 1) * $every) + 1;
            $avgRangeEnd = floor(($i + 2) * $every) + 1;
            $avgRangeEnd = $avgRangeEnd < $dataLength ? $avgRangeEnd : $dataLength;

            $avgRangeLength = $avgRangeEnd - $avgRangeStart;

            for (; $avgRangeStart < $avgRangeEnd; $avgRangeStart++) {
                $avgX += $data[$avgRangeStart][0] * 1; // * 1 enforces Number (value may be Date)
                $avgY += $data[$avgRangeStart][1] * 1;
            }
            $avgX /= $avgRangeLength;
            $avgY /= $avgRangeLength;

            // Get the range for this bucket
            $rangeOffs = floor(($i + 0) * $every) + 1;
            $rangeTo = floor(($i + 1) * $every) + 1;

            // Point a
            $pointAX = $data[$a][0] * 1; // enforce Number (value may be Date)
            $pointAY = $data[$a][1] * 1;

            $maxArea = $area = -1;

            for (; $rangeOffs < $rangeTo; $rangeOffs++) {
                // Calculate triangle area over three buckets
                $area = abs(($pointAX - $avgX)*($data[$rangeOffs][1] - $pointAY)-($pointAX - $data[$rangeOffs][0])*($avgY - $pointAY)) * 0.5;
                if ($area > $maxArea) {
                    $maxArea = $area;
                    $maxAreaPoint = $data[$rangeOffs ];
                    $nextA = $rangeOffs; // Next a is this b
                }
            }

            $sampled[$sampledIndex++] = $maxAreaPoint; // Pick this point from the bucket
            $a = $nextA; // This a is the next a (chosen b)
        }

        $sampled[$sampledIndex] = $data[$dataLength - 1 ]; // Always add last

        return $sampled;
    }
}

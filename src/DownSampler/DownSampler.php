<?php
/**
 * DownSampler.php
 *
 * @author dbojdo - Daniel Bojdo <daniel.bojdo@web-it.eu>
 * Created on Mar 16, 2015, 10:03
 */

namespace Webit\DownSampling\DownSampler;

/**
 * Defines the contract for the downsampling process
 */
interface DownSampler
{
    /**
     * @param array $data
     * @param int $threshold
     * @return array
     */
    public function sampleDown(array $data, int $threshold): array;
}

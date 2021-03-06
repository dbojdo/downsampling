<?php
/**
 * DownSampler.php
 *
 * @author dbojdo - Daniel Bojdo <daniel.bojdo@web-it.eu>
 * Created on Mar 16, 2015, 10:03
 */

namespace Webit\DownSampling\DownSampler;

/**
 * Class DownSampler
 * @package Webit\DownSampling\DownSampler
 */
interface DownSampler
{
    /**
     * @param array $data
     * @param int $threshold
     * @return array
     */
    public function sampleDown(array $data, $threshold);
}

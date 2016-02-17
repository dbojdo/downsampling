<?php
/**
 * File MultiColumnDownSampler.php
 * Created at: 2016-02-17 05-08
 *
 * @author Daniel Bojdo <daniel.bojdo@web-it.eu>
 */

namespace Webit\DownSampling\DownSampler;

interface MultiColumnDownSampler
{
    /**
     * @param @param array[] $data (array of ["k1" => "key", "k2" => "value", "k3" => "value", ...] arrays)
     * @param MultiColumnDownSamplerContext $context
     * @return array[]
     */
    public function sampleDown(array $data, MultiColumnDownSamplerContext $context);
}

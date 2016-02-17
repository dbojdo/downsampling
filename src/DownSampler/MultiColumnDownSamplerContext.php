<?php
/**
 * File MultiColumnDownSamplerContext.php
 * Created at: 2016-02-17 05-30
 *
 * @author Daniel Bojdo <daniel.bojdo@web-it.eu>
 */

namespace Webit\DownSampling\DownSampler;

class MultiColumnDownSamplerContext
{
    /**
     * @var int
     */
    private $threshold;

    /**
     * @var mixed|null
     */
    private $xKey;

    /**
     * @var mixed[]
     */
    private $yKeys;

    /**
     * MultiColumnDownSamplerContext constructor.
     * @param int $threshold
     * @param mixed[] $yKeys
     * @param mixed|null $xKey
     *
     */
    public function __construct($threshold, array $yKeys, $xKey = null)
    {
        $this->threshold = (int) $threshold;
        $this->xKey = $xKey;
        $this->yKeys = $yKeys;
    }

    /**
     * @return int
     */
    public function threshold()
    {
        return $this->threshold;
    }

    /**
     * @return mixed|null
     */
    public function xKey()
    {
        return $this->xKey;
    }

    /**
     * @return mixed[]
     */
    public function yKeys()
    {
        return $this->yKeys;
    }
}

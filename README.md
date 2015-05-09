# Web-IT Downsampling Library

Simple interface for Downsampling algorithms

## Installation
### via Composer

Add the **webit/downsampling** into **composer.json**

```json
{
    "require": {
        "php":              ">=5.3.2",
        "webit/downsampling": "~1.0"
    }
}
```

## Usage
```php
use Webit\DownSampling\DownSampler\LargestTriangleThreeBucketsDownSampler;

$data = array();
for ($i=0; $i < 500; $i++) {
    $data[] = mt_rand(0, 200);
}

$sampler = new LargestTriangleThreeBucketsDownSampler();
$sampled = $sampler->sampleDown($data, 100);
echo count($sampled); // displays 100
```

## Algorithms provided
*   Largest-Triangle-Three-Buckets or LTTB (PHP port of flot-downsample, see: [https://github.com/sveinn-steinarsson/flot-downsample](https://github.com/sveinn-steinarsson/flot-downsample ""))

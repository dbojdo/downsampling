# Web-IT Downsampling Library

A simple interface for Downsampling algorithms

## Installation
### via Composer

Add the **webit/downsampling** into **composer.json**

```json
{
    "require": {
        "php":              ">=7.1",
        "webit/downsampling": "^2.0.0"
    }
}
```

## Usage
```php
use Webit\DownSampling\DownSampler\LargestTriangleThreeBucketsDownSampler;

$data = array();
for ($i=0; $i < 500; $i++) {
    $data[] = [$i, mt_rand(0, 200)];
}

$sampler = new LargestTriangleThreeBucketsDownSampler();
$sampled = $sampler->sampleDown($data, 100);
echo count($sampled); // displays 100
```

## Algorithms provided
*   Largest-Triangle-Three-Buckets or LTTB (PHP port of flot-downsample, see: [https://github.com/sveinn-steinarsson/flot-downsample](https://github.com/sveinn-steinarsson/flot-downsample ""))

<?php

require __DIR__ . '/libs/php-recipe-2nd/make_chart_parts.php';
require __DIR__ . '/config.php';

$output = $config['cacheDir'] . '/benchmark-results.json';
$results = json_decode(file_get_contents($output), true);

$barColors = array('blue', 'red', 'orange', 'green', 'purple');

// Time Benchmark
$data[] = array('', 'time', array('role' => 'style'));  // header

$colors = $barColors;
foreach ($results as $parser => $result) {
    $data[] = array($parser, $result['time'], array_shift($colors));
}
//var_dump($data); exit;

$options = array(
  'title'  => 'Time Benchmark',
  'titleTextStyle' => array('fontSize' => 16),
  'hAxis'  => array('title' => 'time (sec)',
                    'titleTextStyle' => array('bold' => true)),
  'vAxis'  => array('minValue' => 0, 'maxValue' => 0.01),
  'width'  => 500,
  'height' => 400,
  'bar'    => array('groupWidth' => '90%'),
  'legend' => array('position' => 'none')
);
$type = 'ColumnChart';
list($chart_time, $div_time) = makeChartParts($data, $options, $type);

// Memory Benchmark
$data = array();
$data[] = array('', 'memory', array('role' => 'style'));  // header

$colors = $barColors;
foreach ($results as $parser => $result) {
    $data[] = array($parser, ($result['memory']/1024)/1024, array_shift($colors));
}

$options = array(
  'title'  => 'Memory Benchmark',
  'titleTextStyle' => array('fontSize' => 16),
  'hAxis'  => array('title' => 'peak memory (MB)',
                    'titleTextStyle' => array('bold' => true)),
  'vAxis'  => array('minValue' => 0, 'maxValue' => 1),
  'width'  => 500,
  'height' => 400,
  'bar'    => array('groupWidth' => '90%'),
  'legend' => array('position' => 'none')
);
$type = 'ColumnChart';
list($chart_mem, $div_mem) = makeChartParts($data, $options, $type);
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<title>User Agent Parser Benchmarks</title>
<script src="https://www.google.com/jsapi"></script>
<script>
<?php
echo $chart_time, $chart_mem;
?>
</script>
</head>
<body>
<div>
<?php
echo $div_time, $div_mem;
?>
</div>

<hr>

<footer>
    <p style="text-align: right"><a href="./">Back</a> | This page is a part of <a href="https://github.com/kenjis/user-agent-parser-benchmarks">user-agent-parser-benchmarks</a>.</p>
</footer>
</body>
</html>

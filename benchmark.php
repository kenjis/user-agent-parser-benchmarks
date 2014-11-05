<?php

require __DIR__ . '/libs/make_chart_parts.php';

$output = __DIR__ . '/cache/benchmark-results.json';
$results = json_decode(file_get_contents($output), true);

// Time Benchmark
$data[] = array('', 'time', array('role' => 'style'));  // header

$colors = array('blue', 'green', 'red');
foreach ($results as $parser => $result) {
    $data[] = array($parser, $result['time'], array_shift($colors));
}
//var_dump($data); exit;

$options = array(
  'title'  => 'Time Benchmark',
  'titleTextStyle' => array('fontSize' => 16),
  'hAxis'  => array('title' => 'time'),
  'vAxis'  => array('minValue' => 0, 'maxValue' => 20,
                    'title' => 'Unit: secs'),
  'width'  => 500,
  'height' => 400,
  'bar'    => array('groupWidth' => '50%'),
  'legend' => array('position' => 'none')
);
$type = 'ColumnChart';
list($chart_time, $div_time) = makeChartParts($data, $options, $type);

// Memory Benchmark
$data = array();
$data[] = array('', 'memory', array('role' => 'style'));  // header

$colors = array('blue', 'green', 'red');
foreach ($results as $parser => $result) {
    $data[] = array($parser, ($result['memory']/1024), array_shift($colors));
}

$options = array(
  'title'  => 'Memory Benchmark',
  'titleTextStyle' => array('fontSize' => 16),
  'hAxis'  => array('title' => 'peak memory'),
  'vAxis'  => array('minValue' => 0, 'maxValue' => 7500,
                    'title' => 'Unit: KB'),
  'width'  => 500,
  'height' => 400,
  'bar'    => array('groupWidth' => '50%'),
  'legend' => array('position' => 'none')
);
$type = 'ColumnChart';
list($chart_mem, $div_mem) = makeChartParts($data, $options, $type);
?>
<!DOCTYPE html>
<html lang="ja">
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
</body>
</html>

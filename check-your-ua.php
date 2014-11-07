<?php

require __DIR__ . '/vendor/autoload.php';
require __DIR__ . '/config.php';

function h($string)
{
    return htmlspecialchars($string, ENT_QUOTES, 'UTF-8');
}

if (isset($_GET['user_agent']) && trim($_GET['user_agent']) !== '') {
    $userAgent = trim($_GET['user_agent']);
} else {
    $userAgent = $_SERVER['HTTP_USER_AGENT'];
}

// crossjoin-browscap
$browscap = new \Crossjoin\Browscap\Browscap();
$r = $browscap->getBrowser($userAgent)->getData();
$data['crossjoin-browscap'] = array(
    $r->platform, $r->browser, $r->version
);

// get_browser
$testAgent = 'Mozilla/4.0 (compatible; MSIE 7.0; Windows NT 6.0)';
if (@get_browser($testAgent) === false) {
    $data['get_browser'] = array('n/a', 'n/a', 'n/a');
} else {
    $r = get_browser($userAgent);
    $data['get_browser'] = array($r->platform, $r->browser, $r->version);
}

// browscap-php
$cacheDir = __DIR__ . '/cache';
$browscap = new phpbrowscap\Browscap($cacheDir);
$browscap->doAutoUpdate = false;
$r = $browscap->getBrowser($userAgent);
$data['browscap-php'] = array(
    $r->Platform, $r->Browser, $r->Version
);

// ua-parser
$parser = UAParser\Parser::create();
$r = $parser->parse($userAgent);
$data['ua-parser'] = array($r->os->family, $r->ua->family, $r->ua->toVersion());

// woothee
$parser = new \Woothee\Classifier;
$r = $parser->parse($userAgent);
$data['woothee'] = array($r['os'], $r['name'], $r['version']);
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<title>Check Your User Agent</title>
</head>
<body>
<div>
    Your user agent string:<br>
<pre>
<?php
echo '  ' . h($userAgent);
?>
</pre>
</div>

<?php foreach ($config['parsers'] as $parser): ?>
<div>
    <?php echo h($parser); ?>:<br>
<pre>
<?php
echo '  ' . h($data[$parser][0]) . ' / ';
echo h($data[$parser][1]) . ' / ';
echo h($data[$parser][2]);
?>
</pre>
</div>
<?php endforeach; ?>

<hr>

<div>
    <form action="./check-your-ua.php">
        Input user agent string:
        <input type="text" name="user_agent" size="50">
        <input type="submit" value="Send">
    </form>
</div>
</body>
</html>

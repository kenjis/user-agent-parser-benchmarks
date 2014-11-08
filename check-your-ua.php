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

$bench = new Ubench;

// get_browser
$testAgent = 'Mozilla/4.0 (compatible; MSIE 7.0; Windows NT 6.0)';
if (@get_browser($testAgent) === false) {
    $data['get_browser'] = array('n/a', 'n/a', 'n/a');
} else {
    $bench->start();
    $r = get_browser($userAgent);
    $bench->end();
    $data['get_browser'] = array(
        $r->platform, $r->browser, $r->version, $bench->getTime(true)
    );
}

// browscap-php
$bench->start();
$cacheDir = __DIR__ . '/cache';
$browscap = new phpbrowscap\Browscap($cacheDir);
$browscap->doAutoUpdate = false;
$r = $browscap->getBrowser($userAgent);
$bench->end();
$data['browscap-php'] = array(
    $r->Platform, $r->Browser, $r->Version, $bench->getTime(true)
);

// crossjoin-browscap
$bench->start();
\Crossjoin\Browscap\Cache\File::setCacheDirectory($cacheDir);
$updater = new \Crossjoin\Browscap\Updater\None();
\Crossjoin\Browscap\Browscap::setUpdater($updater);
$browscap = new \Crossjoin\Browscap\Browscap();
$r = $browscap->getBrowser($userAgent)->getData();
$bench->end();
$data['crossjoin-browscap'] = array(
    $r->platform, $r->browser, $r->version, $bench->getTime(true)
);

// ua-parser
$bench->start();
$parser = UAParser\Parser::create();
$r = $parser->parse($userAgent);
$bench->end();
$data['ua-parser'] = array(
    $r->os->family, $r->ua->family, $r->ua->toVersion(), $bench->getTime(true)
);

// woothee
$bench->start();
$parser = new \Woothee\Classifier;
$r = $parser->parse($userAgent);
$bench->end();
$data['woothee'] = array(
    $r['os'], $r['name'], $r['version'], $bench->getTime(true)
);
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
echo ' (' . h($data[$parser][3]) . ' sec)';
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

<hr>

<footer>
    <p style="text-align: right"><a href="./">Back</a> | This page is a part of <a href="https://github.com/kenjis/user-agent-parser-benchmarks">user-agent-parser-benchmarks</a>.</p>
</footer>
</body>
</html>

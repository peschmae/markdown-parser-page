<?php
require_once('../vendor/autoload.php');
use Symfony\Component\Yaml\Yaml;

$configFile = './config.yaml';

$config = Yaml::parse(file_get_contents($configFile));

//var_dump($config);exit;

$dirHandle = opendir($config['directories']['data']);
$menuEntry = [];

while(FALSE !== ($entry = readdir($dirHandle))) {
	if (strpos($entry, '.') !== 0) {
		$menuEntry[] = $entry;
		echo $entry . PHP_EOL;
	}
}

closedir($dirHandle);

?>

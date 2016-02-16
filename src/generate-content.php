<?php
require_once('../vendor/autoload.php');
use Symfony\Component\Yaml\Yaml;

$configFile = './config.yaml';

$config = Yaml::parse(file_get_contents($configFile));

//var_dump($config);exit;

$dirHandle = opendir($config['directories']['data']);
$parsedown = new Parsedown();

while(FALSE !== ($entry = readdir($dirHandle))) {
	if (strpos($entry, '.') !== 0) {
		$markdownContent = file_get_contents($config['directories']['data'] . $entry);
		$output = $parsedown->text($markdownContent);
		$fileHandle = fopen($config['directories']['html'] . str_replace('.md', '.html', $entry), 'a+');
		fwrite($fileHandle, $output);
		fclose($fileHandle);
	}
}

closedir($dirHandle);

?>

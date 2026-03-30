<?php

declare(strict_types=1);

$projectRoot = dirname(__DIR__, 4);
$targetDir = $projectRoot . '/extensions/Jojo/config/services';
$targetFile = $targetDir . '/jojo.yaml';

if (!is_dir($targetDir) && !mkdir($targetDir, 0777, true) && !is_dir($targetDir)) {
    fwrite(STDERR, "Failed to create directory: {$targetDir}\n");
    exit(1);
}

$yaml = <<<YAML
imports:
  - { resource: "../../../../vendor/ben-balke/jojo-suitecrm/config/services.yaml" }

YAML;

if (file_put_contents($targetFile, $yaml) === false) {
    fwrite(STDERR, "Failed to write file: {$targetFile}\n");
    exit(1);
}

echo "Installed Jojo extension file: {$targetFile}\n";
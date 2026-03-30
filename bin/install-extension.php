<?php

// bin/install-extension.php
$targetDir = __DIR__ . '/../../../../extensions/Jojo/config/services';
@mkdir($targetDir, 0777, true);

file_put_contents(
    $targetDir . '/jojo.yaml',
    "imports:\n  - { resource: \"%kernel.project_dir%/vendor/ben-balke/jojo-suitecrm/config/services.yaml\" }\n"
);
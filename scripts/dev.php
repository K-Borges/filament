<?php

$hasPail = function_exists('pcntl_fork');

$commands = [
    ['name' => 'server', 'color' => '#93c5fd', 'cmd' => 'php artisan serve'],
    ['name' => 'queue',  'color' => '#c4b5fd', 'cmd' => 'php artisan queue:listen --tries=1 --timeout=0'],
];

if ($hasPail) {
    $commands[] = ['name' => 'logs', 'color' => '#fb7185', 'cmd' => 'php artisan pail --timeout=0'];
} else {
    fwrite(STDERR, "[dev] Extensão pcntl ausente (Windows): pulando 'php artisan pail'.\n");
}

$nvmNode = glob($_SERVER['HOME'] . '/.nvm/versions/node/v2*/bin') ?: [];
rsort($nvmNode);
$nodeBin = $nvmNode ? $nvmNode[0] : null;
$pathEnv = $nodeBin ? $nodeBin . ':' . getenv('PATH') : getenv('PATH');
putenv('PATH=' . $pathEnv);

$commands[] = ['name' => 'vite', 'color' => '#fdba74', 'cmd' => 'npm run dev'];

$colors = implode(',', array_column($commands, 'color'));
$names  = implode(',', array_column($commands, 'name'));
$quoted = implode(' ', array_map(fn ($c) => '"' . $c['cmd'] . '"', $commands));

$full = sprintf(
    'npx concurrently -c "%s" %s --names=%s --kill-others',
    $colors,
    $quoted,
    $names
);

passthru($full, $exitCode);

exit($exitCode);

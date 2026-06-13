<?php

/*
|--------------------------------------------------------------------------
| Launcher de desenvolvimento multiplataforma
|--------------------------------------------------------------------------
|
| Sobe os processos de desenvolvimento (server, queue, logs, vite) via
| `npx concurrently`. O `php artisan pail` (logs) exige a extensão `pcntl`,
| que só existe em Unix/Linux — no Windows ela não está disponível e o pail
| derruba todos os outros processos por causa do --kill-others.
|
| Por isso o pail só é incluído quando `pcntl` está presente. Assim o mesmo
| `composer dev` funciona tanto no Linux quanto no Windows.
|
*/

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

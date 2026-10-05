<?php
/**
 * Safir Business Hub — Web Migration Runner
 * Enables database migrations on production servers without SSH access.
 * Visit: https://[domain.com]/migrate.php
 */

define('LARAVEL_START', microtime(true));

// Load Composer autoloader
if (!file_exists(__DIR__ . '/../vendor/autoload.php')) {
    die('Composer autoloader not found. Please ensure project dependencies are deployed.');
}
require __DIR__ . '/../vendor/autoload.php';

// Bootstrap Laravel
$app = require_once __DIR__ . '/../bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);

$outputLog = '';
$status = 'idle';
$action = $_GET['action'] ?? null;
$token = $_GET['key'] ?? ($_POST['key'] ?? null);

// Optional security token check if configured in .env as MIGRATE_SECRET_KEY
$envSecret = env('MIGRATE_SECRET_KEY', 'safir2026');
$isAuthorized = empty($envSecret) || ($token === $envSecret);

if ($action && $isAuthorized) {
    ob_start();
    try {
        if ($action === 'migrate') {
            echo "Running: php artisan migrate --force\n";
            echo str_repeat('-', 50) . "\n";
            $kernel->call('migrate', ['--force' => true]);
            echo $kernel->output();
            $status = 'success';
        } elseif ($action === 'seed') {
            echo "Running: php artisan db:seed --force\n";
            echo str_repeat('-', 50) . "\n";
            $kernel->call('db:seed', ['--force' => true]);
            echo $kernel->output();
            $status = 'success';
        } elseif ($action === 'optimize') {
            echo "Running: php artisan optimize:clear\n";
            echo str_repeat('-', 50) . "\n";
            $kernel->call('optimize:clear');
            echo $kernel->output();
            $status = 'success';
        }
    } catch (\Throwable $e) {
        $status = 'error';
        echo "\nERROR: " . $e->getMessage() . "\n" . $e->getTraceAsString();
    }
    $outputLog = ob_get_clean();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Safir Business Hub — Web Migration Console</title>
    <style>
        :root {
            --primary: #0A192F;
            --secondary: #112240;
            --accent: #D4AF37;
            --accent-hover: #C5A059;
            --text-light: #F8FAFC;
            --text-muted: #94A3B8;
            --success: #10B981;
            --error: #EF4444;
        }
        body {
            font-family: -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, sans-serif;
            background-color: var(--primary);
            color: var(--text-light);
            margin: 0;
            padding: 40px 20px;
            display: flex;
            justify-content: center;
        }
        .container {
            max-width: 850px;
            width: 100%;
            background: var(--secondary);
            border: 1px solid rgba(212, 175, 55, 0.25);
            border-radius: 12px;
            padding: 35px;
            box-shadow: 0 20px 40px rgba(0,0,0,0.5);
        }
        .header {
            display: flex;
            align-items: center;
            justify-content: space-between;
            border-bottom: 1px solid rgba(255,255,255,0.1);
            padding-bottom: 20px;
            margin-bottom: 25px;
        }
        .logo-title h1 {
            margin: 0;
            font-size: 22px;
            color: var(--accent);
            letter-spacing: 0.5px;
        }
        .logo-title p {
            margin: 5px 0 0 0;
            color: var(--text-muted);
            font-size: 14px;
        }
        .actions {
            display: flex;
            flex-wrap: wrap;
            gap: 12px;
            margin-bottom: 25px;
        }
        .btn {
            background: var(--accent);
            color: #0A192F;
            font-weight: 600;
            padding: 12px 24px;
            border-radius: 6px;
            text-decoration: none;
            transition: all 0.2s ease;
            display: inline-flex;
            align-items: center;
            gap: 8px;
            font-size: 14px;
            border: none;
            cursor: pointer;
        }
        .btn:hover {
            background: var(--accent-hover);
            transform: translateY(-1px);
        }
        .btn-outline {
            background: transparent;
            color: var(--text-light);
            border: 1px solid rgba(255,255,255,0.2);
        }
        .btn-outline:hover {
            background: rgba(255,255,255,0.05);
            border-color: var(--accent);
            color: var(--accent);
        }
        .console-box {
            background: #050C1A;
            border: 1px solid rgba(255,255,255,0.08);
            border-radius: 8px;
            padding: 20px;
            font-family: "Courier New", Courier, monospace;
            font-size: 13px;
            color: #38BDF8;
            white-space: pre-wrap;
            max-height: 400px;
            overflow-y: auto;
            line-height: 1.6;
        }
        .badge-success { color: var(--success); font-weight: bold; }
        .badge-error { color: var(--error); font-weight: bold; }
        .notice {
            background: rgba(212, 175, 55, 0.08);
            border-left: 4px solid var(--accent);
            padding: 15px 20px;
            border-radius: 4px;
            margin-bottom: 25px;
            font-size: 14px;
            line-height: 1.5;
            color: #E2E8F0;
        }
        .return-link {
            display: block;
            margin-top: 25px;
            color: var(--accent);
            text-decoration: none;
            font-size: 14px;
        }
        .return-link:hover { text-decoration: underline; }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <div class="logo-title">
                <h1>Safir Business Hub — Live Migration Console</h1>
                <p>Ankara Diplomatic & Corporate Advisory Platform · Safe Live Migration Tool</p>
            </div>
            <div>
                <span style="font-size: 12px; background: rgba(212,175,55,0.15); color: var(--accent); padding: 4px 10px; border-radius: 20px; border: 1px solid rgba(212,175,55,0.3);">
                    SSH-Free Web Runner
                </span>
            </div>
        </div>

        <div class="notice">
            <strong>Deployment Protocol:</strong> This script executes live database migrations and cache optimizations safely without requiring SSH or terminal access on shared/cPanel/cloud hosting environments.
        </div>

        <div class="actions">
            <a href="?action=migrate&key=<?= htmlspecialchars($token ?? 'safir2026') ?>" class="btn">
                Run Migrations (migrate --force)
            </a>
            <a href="?action=seed&key=<?= htmlspecialchars($token ?? 'safir2026') ?>" class="btn btn-outline">
                Run Seeders (db:seed)
            </a>
            <a href="?action=optimize&key=<?= htmlspecialchars($token ?? 'safir2026') ?>" class="btn btn-outline">
                Clear Caches (optimize:clear)
            </a>
        </div>

        <?php if ($status !== 'idle'): ?>
            <h3>Execution Output:</h3>
            <div class="console-box">
                <?= htmlspecialchars($outputLog) ?>
                <div style="margin-top: 15px;">
                    <?php if ($status === 'success'): ?>
                        <span class="badge-success">✔ EXECUTION COMPLETED SUCCESSFULLY</span>
                    <?php else: ?>
                        <span class="badge-error">✖ EXECUTION FAILED</span>
                    <?php endif; ?>
                </div>
            </div>
        <?php else: ?>
            <div class="console-box" style="color: var(--text-muted);">
Ready to execute. Click one of the action buttons above to run live migrations on the server.
            </div>
        <?php endif; ?>

        <a href="/" class="return-link">← Return to Safir Business Hub Homepage</a>
    </div>
</body>
</html>

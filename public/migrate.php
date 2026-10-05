<?php
/**
 * Safir Business Hub — Live Migration Console
 * Secure web runner for database migrations without SSH access.
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
$action = $_POST['action'] ?? ($_GET['action'] ?? null);
$token = (string)($_POST['key'] ?? ($_GET['key'] ?? ''));

// Required security token configured in .env as MIGRATE_SECRET_KEY
$envSecret = (string)env('MIGRATE_SECRET_KEY', 'safir2026');
$isAuthorized = !empty($token) && hash_equals($envSecret, $token);

if ($action) {
    if (!$isAuthorized) {
        $status = 'error';
        $outputLog = "AUTHENTICATION ERROR: Access Denied.\nInvalid or missing Security Secret Key.\nPlease enter the valid secret key below to execute database operations.";
    } else {
        ob_start();
        try {
            if ($action === 'migrate') {
                echo "Running: php artisan migrate --force\n";
                echo str_repeat('-', 50) . "\n";
                $kernel->call('migrate', ['--force' => true]);
                echo $kernel->output();
                $status = 'success';
            } elseif ($action === 'status') {
                echo "Running: php artisan migrate:status\n";
                echo str_repeat('-', 50) . "\n";
                $kernel->call('migrate:status');
                echo $kernel->output();
                $status = 'success';
            } elseif ($action === 'optimize') {
                echo "Running: php artisan optimize:clear\n";
                echo str_repeat('-', 50) . "\n";
                $kernel->call('optimize:clear');
                echo $kernel->output();
                $status = 'success';
            } else {
                echo "Error: Unknown action '{$action}'.";
                $status = 'error';
            }
        } catch (\Throwable $e) {
            $status = 'error';
            echo "\nERROR: " . $e->getMessage() . "\n" . $e->getTraceAsString();
        }
        $outputLog = ob_get_clean();
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Safir Business Hub — Live Migration Console</title>
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
            --border: rgba(212, 175, 55, 0.25);
        }
        * {
            box-sizing: border-box;
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
            border: 1px solid var(--border);
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
        .badge {
            font-size: 12px;
            background: rgba(212,175,55,0.15);
            color: var(--accent);
            padding: 4px 10px;
            border-radius: 20px;
            border: 1px solid rgba(212,175,55,0.3);
            font-weight: 500;
        }
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
        .auth-card {
            background: rgba(5, 12, 26, 0.6);
            border: 1px solid rgba(255,255,255,0.1);
            border-radius: 8px;
            padding: 20px;
            margin-bottom: 25px;
        }
        .auth-label {
            display: block;
            font-size: 12px;
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: 0.05em;
            color: var(--accent);
            margin-bottom: 8px;
        }
        .input-row {
            display: flex;
            gap: 10px;
            align-items: center;
        }
        .key-input {
            flex: 1;
            padding: 11px 16px;
            background: #050C1A;
            border: 1px solid rgba(255,255,255,0.2);
            border-radius: 6px;
            color: #F8FAFC;
            font-family: monospace;
            font-size: 14px;
            outline: none;
            transition: border-color 0.2s;
        }
        .key-input:focus {
            border-color: var(--accent);
            box-shadow: 0 0 0 2px rgba(212,175,55,0.2);
        }
        .toggle-btn {
            background: rgba(255,255,255,0.08);
            border: 1px solid rgba(255,255,255,0.15);
            color: var(--text-light);
            padding: 11px 14px;
            border-radius: 6px;
            cursor: pointer;
            font-size: 13px;
        }
        .toggle-btn:hover {
            background: rgba(255,255,255,0.15);
        }
        .actions {
            display: flex;
            flex-wrap: wrap;
            gap: 12px;
            margin-top: 20px;
        }
        .btn {
            background: var(--accent);
            color: #0A192F;
            font-weight: 700;
            padding: 12px 22px;
            border-radius: 6px;
            text-decoration: none;
            transition: all 0.2s ease;
            display: inline-flex;
            align-items: center;
            gap: 8px;
            font-size: 13px;
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
            margin-top: 15px;
        }
        .badge-success { color: var(--success); font-weight: bold; }
        .badge-error { color: var(--error); font-weight: bold; }
        .return-link {
            display: inline-block;
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
                <span class="badge">Protected by Secret Key</span>
            </div>
        </div>

        <div class="notice">
            <strong>Security Notice:</strong> Database migration execution requires authorization via the secure Secret Key (<code>MIGRATE_SECRET_KEY</code>). Database seeders have been permanently disabled on this runner to safeguard production data integrity.
        </div>

        <form method="POST" action="migrate.php">
            <div class="auth-card">
                <label class="auth-label" for="secret-key">Security Secret Key (Required):</label>
                <div class="input-row">
                    <input type="password" id="secret-key" name="key" value="<?= htmlspecialchars($token) ?>" placeholder="Enter MIGRATE_SECRET_KEY..." required class="key-input" autocomplete="current-password">
                    <button type="button" onclick="toggleVisibility()" class="toggle-btn" id="toggle-btn" title="Toggle Visibility">Show Key</button>
                </div>

                <div class="actions">
                    <button type="submit" name="action" value="migrate" class="btn">
                        ▶ Run Migrations (migrate --force)
                    </button>
                    <button type="submit" name="action" value="status" class="btn btn-outline">
                        ℹ Migration Status (migrate:status)
                    </button>
                    <button type="submit" name="action" value="optimize" class="btn btn-outline">
                        ⚡ Clear Caches (optimize:clear)
                    </button>
                </div>
            </div>
        </form>

        <?php if ($status !== 'idle'): ?>
            <h3 style="font-size: 15px; color: var(--text-light); margin: 20px 0 10px 0;">Execution Output:</h3>
            <div class="console-box" style="<?= $status === 'error' ? 'color: #F87171;' : '' ?>">
<?= htmlspecialchars($outputLog) ?>
                <div style="margin-top: 15px; padding-top: 10px; border-top: 1px dashed rgba(255,255,255,0.1);">
                    <?php if ($status === 'success'): ?>
                        <span class="badge-success">✔ EXECUTION COMPLETED SUCCESSFULLY</span>
                    <?php else: ?>
                        <span class="badge-error">✖ EXECUTION FAILED / ACCESS DENIED</span>
                    <?php endif; ?>
                </div>
            </div>
        <?php else: ?>
            <div class="console-box" style="color: var(--text-muted);">
Ready to execute. Enter your secret key above and click an action button to perform operations safely.
            </div>
        <?php endif; ?>

        <a href="/" class="return-link">← Return to Safir Business Hub Homepage</a>
    </div>

    <script>
        function toggleVisibility() {
            var input = document.getElementById('secret-key');
            var btn = document.getElementById('toggle-btn');
            if (input.type === 'password') {
                input.type = 'text';
                btn.textContent = 'Hide Key';
            } else {
                input.type = 'password';
                btn.textContent = 'Show Key';
            }
        }
    </script>
</body>
</html>

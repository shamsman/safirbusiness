<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        if (config('app.env') === 'production' || request()->header('x-forwarded-proto') === 'https') {
            \Illuminate\Support\Facades\URL::forceScheme('https');
        }

        // Register Google Cloud Storage driver
        \Illuminate\Support\Facades\Storage::extend('gcs', function ($app, array $config) {
            $clientConfig = [];

            if (!empty($config['project_id'])) {
                $clientConfig['projectId'] = $config['project_id'];
            }

            $keyFile = $config['key_file'] ?? env('GCS_KEY_FILE');
            $keyJson = $config['key_json'] ?? env('GCS_KEY_JSON');
            $keyBase64 = $config['key_base64'] ?? env('GCS_KEY_BASE64');

            if (!empty($keyBase64)) {
                $decoded = base64_decode($keyBase64, true);
                if ($decoded && str_starts_with(trim($decoded), '{')) {
                    $clientConfig['keyFile'] = json_decode($decoded, true, 512, JSON_THROW_ON_ERROR);
                }
            } elseif (!empty($keyJson)) {
                $clientConfig['keyFile'] = is_array($keyJson) ? $keyJson : json_decode($keyJson, true, 512, JSON_THROW_ON_ERROR);
            } elseif (is_array($keyFile)) {
                $clientConfig['keyFile'] = $keyFile;
            } elseif (is_string($keyFile) && trim($keyFile) !== '') {
                $trimmed = trim($keyFile);
                if (str_starts_with($trimmed, '{')) {
                    $clientConfig['keyFile'] = json_decode($trimmed, true, 512, JSON_THROW_ON_ERROR);
                } else {
                    $resolvedPath = file_exists($trimmed)
                        ? $trimmed
                        : (file_exists(base_path($trimmed)) ? base_path($trimmed) : storage_path(basename($trimmed)));

                    if (file_exists($resolvedPath)) {
                        $clientConfig['keyFilePath'] = $resolvedPath;
                    }
                }
            }

            $client = new \Google\Cloud\Storage\StorageClient($clientConfig);
            $bucketName = $config['bucket'] ?? 'safirbusiness-media';
            $bucket = $client->bucket($bucketName);

            $pathPrefix = $config['path_prefix'] ?? '';
            $visibilityHandler = new \League\Flysystem\GoogleCloudStorage\UniformBucketLevelAccessVisibility();
            $adapter = new \League\Flysystem\GoogleCloudStorage\GoogleCloudStorageAdapter(
                $bucket,
                $pathPrefix,
                $visibilityHandler
            );

            $flysystem = new \League\Flysystem\Filesystem($adapter, $config);

            return new \App\Filesystem\GoogleCloudStorageFilesystemAdapter($flysystem, $adapter, $config);
        });
    }
}

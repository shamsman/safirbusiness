<?php

namespace App\Filesystem;

use Illuminate\Filesystem\FilesystemAdapter;
use League\Flysystem\FilesystemOperator;
use League\Flysystem\GoogleCloudStorage\GoogleCloudStorageAdapter;

class GoogleCloudStorageFilesystemAdapter extends FilesystemAdapter
{
    /**
     * The underlying Google Cloud Storage adapter.
     */
    protected GoogleCloudStorageAdapter $gcsAdapter;

    /**
     * Create a new Google Cloud Storage filesystem adapter instance.
     */
    public function __construct(
        FilesystemOperator $driver,
        GoogleCloudStorageAdapter $adapter,
        array $config = []
    ) {
        parent::__construct($driver, $adapter, $config);
        $this->gcsAdapter = $adapter;
    }

    /**
     * Get the URL for the file at the given path.
     *
     * @param  string  $path
     * @return string
     */
    public function url($path): string
    {
        $uri = !empty($this->config['storage_api_uri']) ? $this->config['storage_api_uri'] : 'https://storage.googleapis.com';
        $bucket = $this->config['bucket'] ?? 'safirbusiness-media';
        $prefix = trim($this->config['path_prefix'] ?? '', '/');
        $cleanPath = ltrim($path, '/');

        $fullPath = $prefix !== '' ? "{$prefix}/{$cleanPath}" : $cleanPath;

        return rtrim($uri, '/') . "/{$bucket}/{$fullPath}";
    }

    /**
     * Get the underlying Google Cloud Storage adapter.
     */
    public function getGcsAdapter(): GoogleCloudStorageAdapter
    {
        return $this->gcsAdapter;
    }
}

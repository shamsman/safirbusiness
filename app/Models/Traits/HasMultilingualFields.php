<?php

namespace App\Models\Traits;

trait HasMultilingualFields
{
    /**
     * Get a localized field value with fallback.
     */
    public function getLocalized(string $field, ?string $locale = null): ?string
    {
        $locale = $locale ?: app()->getLocale();
        $translations = $this->getAttribute($field);

        if (is_string($translations)) {
            $decoded = json_decode($translations, true);
            if (json_last_error() === JSON_ERROR_NONE) {
                $translations = $decoded;
            } else {
                return $translations;
            }
        }

        if (!is_array($translations)) {
            return null;
        }

        if (!empty($translations[$locale])) {
            return $translations[$locale];
        }

        // Fallbacks
        $fallbacks = ['en', 'ar', 'tr'];
        foreach ($fallbacks as $fb) {
            if (!empty($translations[$fb])) {
                return $translations[$fb];
            }
        }

        return reset($translations) ?: null;
    }
}

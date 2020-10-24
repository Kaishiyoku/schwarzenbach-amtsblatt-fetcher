<?php

if (!function_exists('toFileSlug')) {
    /**
     * @param \App\Models\File $file
     * @return string
     */
    function toFileSlug(\App\Models\File $file): string
    {
        return $file->no . '-' . $file->published_at->toDateString();
    }
}

if (!function_exists('getFileIdFromSlug')) {
    /**
     * @param string $fileSlug
     * @return array
     * @throws \Carbon\Exceptions\InvalidFormatException
     */
    function getFileIdAndDateFromSlug(string $fileSlug): array
    {
        [$no, $dateStr] = explode('-', $fileSlug, 2);

        return [
            (int)$no,
            \Carbon\Carbon::parse($dateStr),
        ];
    }
}

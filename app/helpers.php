<?php
/**
 * @link https://github.com/Aikrof
 * @author Denys <denys.minakov@gmail.com>
 */

declare(strict_types=1);

if (! \function_exists('trademarkModifier')) {
    /**
     * @param string|int|null $str
     *
     * @return string
     */
    function trademarkModifier(string|int|null $str): ?string {
        if (\is_null($str)) {
            return $str;
        }

        return \html_entity_decode(
            \preg_filter('/\b\w{6}\b/u', '$0&trade;', (string) $str) ?? (string) $str
        );
    }
}

if (! \function_exists('diffTimeAgo')) {
    /**
     * @param \Carbon\Carbon $time
     *
     * @return string
     */
    function diffTimeAgo(\Carbon\Carbon $time): string {
        /** @var Carbon\Carbon $diff */
        $diff = $time->diff(now());

        /** @var array */
        $diffData = [
            [$diff->y, 'years ago.'],
            [$diff->m, 'month ago.'],
            [$diff->d, 'days ago.'],
            [$diff->h, 'hours ago.'],
            [$diff->i, 'minutes ago.'],
            [$diff->s, 'seconds ago'],
        ];

        return \implode(' ', \Illuminate\Support\Arr::first($diffData, (static function ($data) {
            return \current($data) !== 0;
        })));
    }
}

<?php
/**
 * @link https://github.com/Aikrof
 * @package App\Wrappers\Hackernews\Utils
 * @author Denys <denys.minakov@gmail.com>
 */

declare(strict_types=1);

namespace App\Wrappers\Hackernews\Utils;

/**
 * Class Show
 */
class Show extends BaseUtil implements Utilable
{
    /**
     * Show stories uri
     */
    public const URI = 'showstories.json';

    /**
     * {@inheritDoc}
     *
     * @return string
     */
    public function getUri(): string
    {
        return static::URI;
    }
}

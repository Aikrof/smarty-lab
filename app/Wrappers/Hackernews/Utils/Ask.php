<?php
/**
 * @link https://github.com/Aikrof
 * @package App\Wrappers\Hackernews\Utils
 * @author Denys <denys.minakov@gmail.com>
 */

declare(strict_types=1);

namespace App\Wrappers\Hackernews\Utils;

/**
 * Class Ask
 */
class Ask extends BaseUtil implements Utilable
{
    /**
     * Ask stories uri
     */
    public const URI = 'askstories.json';

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

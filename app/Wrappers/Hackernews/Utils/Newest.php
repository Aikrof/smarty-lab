<?php
/**
 * @link https://github.com/Aikrof
 * @package App\Wrappers\Hackernews\Utils
 * @author Denys <denys.minakov@gmail.com>
 */

declare(strict_types=1);

namespace App\Wrappers\Hackernews\Utils;

/**
 * Class Newest
 */
class Newest extends BaseUtil implements Utilable
{
    /**
     * Top & new stories uri
     */
    public const URI = 'newstories.json';

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

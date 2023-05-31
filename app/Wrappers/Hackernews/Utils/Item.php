<?php
/**
 * @link https://github.com/Aikrof
 * @package App\Wrappers\Hackernews\Utils
 * @author Denys <denys.minakov@gmail.com>
 */

declare(strict_types=1);

namespace App\Wrappers\Hackernews\Utils;

/**
 * Class Item
 */
class Item extends BaseUtil implements Utilable
{
    /**
     * Job stories uri
     */
    public const URI = 'maxitem.json';

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

<?php
/**
 * @link https://github.com/Aikrof
 * @package App\Facades
 * @author Denys <denys.minakov@gmail.com>
 */

declare(strict_types=1);

namespace App\Facades;

use App\Wrappers\Hackernews\HackerNewsManagerInterface;
use Illuminate\Support\Facades\Facade;

/**
 * Class HackerNews
 *
 * @see \Illuminate\Support\Facades\Facade
 */
class HackerNews extends Facade
{
    /**
     * {@inheritDoc}
     *
     * @return string
     */
    protected static function getFacadeAccessor(): string
    {
        return HackerNewsManagerInterface::class;
    }
}

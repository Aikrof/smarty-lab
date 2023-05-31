<?php
/**
 * @link https://github.com/Aikrof
 * @package App\Wrappers\Hackernews
 * @author Denys <denys.minakov@gmail.com>
 */

declare(strict_types=1);

namespace App\Wrappers\Hackernews;

use App\Wrappers\Hackernews\Utils\Ask;
use App\Wrappers\Hackernews\Utils\Item;
use App\Wrappers\Hackernews\Utils\Job;
use App\Wrappers\Hackernews\Utils\Newest;
use App\Wrappers\Hackernews\Utils\Show;
use App\Wrappers\Hackernews\Utils\Top;
use App\Wrappers\Hackernews\Utils\Update;

/**
 * Interface HackerNewsManagerInterface
 */
interface HackerNewsManagerInterface
{
    /**
     * Get item util instance
     *
     * @return Item
     */
    public function item(): Item;

    /**
     * Get ask util instance
     *
     * @return Ask
     */
    public function ask(): Ask;

    /**
     * Get job util instance
     *
     * @return Job
     */
    public function job(): Job;

    /**
     * Get show util instance
     *
     * @return Show
     */
    public function show(): Show;

    /**
     * Get top util instance
     *
     * @return Top
     */
    public function top(): Top;

    /**
     * Get Newest util instance
     *
     * @return Newest
     */
    public function new(): Newest;
}

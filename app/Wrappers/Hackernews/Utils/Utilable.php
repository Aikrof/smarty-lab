<?php
/**
 * @link https://github.com/Aikrof
 * @package App\Wrappers\Hackernews\Utils
 * @author Denys <denys.minakov@gmail.com>
 */

declare(strict_types=1);

namespace App\Wrappers\Hackernews\Utils;

use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Collection;

/**
 * Interface Utilable
 */
interface Utilable
{
    /**
     * Get raw stories data
     *
     * @return Collection
     */
    public function get(): Collection;

    /**
     * @param string|int|array $id
     *
     * @return Collection
     */
    public function getItem(string|int|array $id): Collection;

    /**
     * @param int       $perPage
     * @param int|null  $page
     * @param array     $options
     *
     * @return LengthAwarePaginator
     */
    public function paginate(int $perPage = 30, int|string $page = null, array $options = []): LengthAwarePaginator;
}

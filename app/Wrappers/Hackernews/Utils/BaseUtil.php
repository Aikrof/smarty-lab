<?php
/**
 * @link https://github.com/Aikrof
 * @package App\Wrappers\Hackernews\Utils
 * @author Denys <denys.minakov@gmail.com>
 */

declare(strict_types=1);

namespace App\Wrappers\Hackernews\Utils;

use Illuminate\Http\Client\PendingRequest;
use Illuminate\Http\Client\Pool;
use Illuminate\Support\Arr;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Http;
use Illuminate\Pagination\Paginator;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Http\Client\Response;

/**
 * Abstract class BaseUtil
 */
abstract class BaseUtil implements Utilable
{
    /**
     * Base hacker news url
     */
    public const BASE_URL = 'https://hacker-news.firebaseio.com/v0';

    /**
     * BaseUtil constructor.
     *
     * @param PendingRequest|null $request
     */
    public function __construct(?PendingRequest $request)
    {
        $this->request = $request ?: $request->baseUrl(static::BASE_URL)
            ->acceptJson()
            ->contentType('application/json')
            ->withUrlParameters(['print' => 'pretty']);
    }

    /**
     * @return string
     */
    abstract public function getUri(): string;

    /**
     * Get data
     *
     * @return Collection
     */
    public function get(): Collection
    {
        return $this->request->get($this->getUri())->collect();
    }

    /**
     * {@inheritDoc}
     *
     * @param string|int|array $id
     *
     * @return Collection
     */
    public function getItem(string|int|array $ids): Collection
    {
        return !\is_array($ids)
            ? $this->request->get("/item/{$ids}.json")->throw()->collect()
            : (function () use ($ids): Collection {

                /** @var Response[] $responses */
                $responses = $this->request->pool(function (Pool $pool) use ($ids) {
                    foreach ($ids as $index => $id) {
                        $pool->as((string) $index)->baseUrl(static::BASE_URL)->get("/item/{$id}.json");
                    }
                });

                return (new Collection($responses))->map(fn (Response $response) => $response->throw()->json());
            })();
    }

    /**
     * @param int       $perPage
     * @param int|null  $page
     * @param array     $options
     *
     * @return LengthAwarePaginator
     */
    public function paginate(int $perPage = 30, int|string $page = null, array $options = []): LengthAwarePaginator
    {
        $page = $page ?: (Paginator::resolveCurrentPage() ?: 1);

        /** @var Collection $items */
        $items = $this->get();

        return new LengthAwarePaginator(
            $this->getItem($items->forPage($page, $perPage)->toArray()),
            $items->count(),
            $perPage,
            $page,
            $options
        );
    }
}

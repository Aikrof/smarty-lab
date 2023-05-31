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
use Illuminate\Foundation\Application;
use Illuminate\Http\Client\PendingRequest;
use Illuminate\Support\Facades\Http;

/**
 * Class HackerNewsManager
 */
class HackerNewsManager implements HackerNewsManagerInterface
{
    /**
     * @var Application
     */
    private Application $app;

    /**
     * @var PendingRequest
     */
    private PendingRequest $request;

    /**
     * HackerNewsManager constructor.
     */
    public function __construct(Application $app)
    {
        $this->app = $app;

        /** @see \App\Providers\AppServiceProvider::defineHttpMacro */
        $this->request = Http::HackerNews();
    }

    /**
     * {@inheritDoc}
     *
     * @return Item
     */
    public function item(): Item
    {
        return $this->make(Item::class, ['request' => $this->request]);
    }

    /**
     * {@inheritDoc}
     *
     * @return Ask
     */
    public function ask(): Ask
    {
        return $this->make(Ask::class, ['request' => $this->request]);
    }

    /**
     * {@inheritDoc}
     *
     * @return Job
     */
    public function job(): Job
    {
        return $this->make(Job::class, ['request' => $this->request]);
    }

    /**
     * {@inheritDoc}
     *
     * @return Show
     */
    public function show(): Show
    {
        return $this->make(Show::class, ['request' => $this->request]);
    }

    /**
     * {@inheritDoc}
     *
     * @return Top
     */
    public function top(): Top
    {
        return $this->make(Top::class, ['request' => $this->request]);
    }

    /**
     * {@inheritDoc}
     *
     * @return Newest
     */
    public function new(): Newest
    {
        return $this->make(Newest::class, ['request' => $this->request]);
    }

    /**
     * Make instance
     *
     * @param string    $abstract
     * @param array     $paramethers
     *
     * @return mixed
     */
    protected function make(string $abstract, array $paramethers = []): mixed
    {
        return $this->app->make($abstract, $paramethers);
    }
}

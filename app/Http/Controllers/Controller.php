<?php
/**
 * @link https://github.com/Aikrof
 * @package App\Wrappers\Hackernews
 * @author Denys <denys.minakov@gmail.com>
 */

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Wrappers\Hackernews\HackerNewsManager;
use App\Wrappers\Hackernews\Utils\Utilable;
use Illuminate\Http\RedirectResponse;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\View\View;

/**
 * Class Controller
 */
class Controller extends BaseController
{
    /**
     * Controller constructor.
     *
     * @param Request           $request
     * @param HackerNewsManager $hackerNews
     */
    public function __construct(
        private Request $request,
        private HackerNewsManager $hackerNews
    ) {
    }

    /**
     * @return View
     */
    public function top(): View
    {
        return $this->makeViewFor('top');
    }

    /**
     * @return View
     */
    public function newest(): View
    {
        return $this->makeViewFor('newest');
    }

    /**
     * @return View
     */
    public function ask(): View
    {
        return $this->makeViewFor('ask');
    }

    /**
     * @return View
     */
    public function show(): View
    {
        return $this->makeViewFor('show');
    }

    /**
     * @return View
     */
    public function jobs(): View
    {
        return $this->makeViewFor('jobs');
    }

    /**
     * @param FormRequest $formRequest
     *
     * @return View|RedirectResponse
     */
    public function item(FormRequest $formRequest): View|RedirectResponse
    {
        /** @var string|int $id */
        if (!$id = $formRequest->query('id')) {
            return \response()->redirectTo('/');
        }

        return \view('index', ['items' => $this->hackerNews->item()->getItem($id)]);
    }

    /**
     * @param string $action
     *
     * @return View
     */
    protected function makeViewFor(string $action): View
    {
        /** @var Utilable|null $util */
        $util = match ($action) {
            'top' => $this->hackerNews->top(),
            'newest' => $this->hackerNews->new(),
            'ask' => $this->hackerNews->ask(),
            'show' => $this->hackerNews->show(),
            'jobs' => $this->hackerNews->job(),
            default => null,
        };

        if (!$util) {
            \abort(404);
        }

        /** @var LengthAwarePaginator $paginator */
        $paginator = $util->paginate();

        return \view(
            'index',
            ['items' => $paginator->items(), 'paginator' => $paginator]
        );
    }
}

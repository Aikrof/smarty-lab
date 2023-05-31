@php
    /** @var \Illuminate\Http\Request $request */
    $request = \app()->make(\Illuminate\Http\Request::class);

    /** @var string $action */
    $action = $request->route()->getActionMethod();

    $nextPage = isset($paginator)
        ? \trim($paginator->nextPageUrl(), '/')
        : null;
@endphp

<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta name="referrer" content="origin">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="{{ \asset('css/news.css') }}" rel="stylesheet">
    <link rel="shortcut icon" href="favicon.ico">
    <title>Hacker News</title>
</head>


<body>
<center>
    <table id="hnmain" width="85%" cellspacing="0" cellpadding="0" border="0" bgcolor="#f6f6ef">
        <tbody>
            @include('templates/header');
            <tr>
                <td>
                    @if($action === 'jobs')
                        <div style="margin-left:14px; margin-top:6px; margin-bottom:14px">
                            {{ \trademarkModifier('These are jobs at YC startups. See more at') }}
                            <a href="">
                                <u>{{ \trademarkModifier('ycombinator.com/jobs') }}</u>
                            </a>.
                        </div>
                    @endif
                    <table cellspacing="0" cellpadding="0" border="0">
                        <tbody>
                        @if ($action === 'item')
                            @include("templates/item", ['item' => $items])
                        @else
                            @foreach($items as $index => $item)

                                @includeWhen(
                                    $action === 'top' || $action === 'newest' || $action === 'show',
                                    "templates/top_or_new",
                                    ['runk' => ++$index, 'item' => new \Illuminate\Support\Collection($item), 'paginator' => $paginator]
                                )

                                @includeWhen(
                                    $action === 'ask',
                                    "templates/ask",
                                    ['runk' => ++$index, 'item' => new \Illuminate\Support\Collection($item), 'paginator' => $paginator]
                                )

                                @includeWhen(
                                    $action === 'jobs',
                                    "templates/job",
                                    ['item' => new \Illuminate\Support\Collection($item), 'paginator' => $paginator]
                                )
                            @endforeach
                        @endif

                        @includeWhen($nextPage, 'templates/more', ['nextPage' => $nextPage])

                        </tbody>
                    </table>
                </td>
            </tr>
        </tbody>
    </table>
</center>
</body>

</html>

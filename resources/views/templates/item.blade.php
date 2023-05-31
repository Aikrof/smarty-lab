@php
    /** @var \Illuminate\Http\Request $request */
    $request = \app()->make(\Illuminate\Http\Request::class);

    /** @var string $action */
    $action = $request->route()->getActionMethod();

    /** @var \Carbon\Carbon $time */
    $time = \Carbon\Carbon::createFromTimestamp($item->get('time'));
@endphp

<tr>
    <td>
        <table class="fatitem" border="0">
            <tbody>
            <tr class="athing" id="{{$item->get('id')}}">
                <td class="title" valign="top" align="right">
                    <span class="rank"></span>
                </td>
                <td class="votelinks" valign="top">
                    <center>
                        <a id="up_{{$item->get('id')}}" class="clicky nosee" href="">
                            <div class="votearrow" title="upvote"></div>
                        </a>
                    </center>
                </td>
                <td class="title">
                    <span class="titleline">
                        <a href="">{{ \trademarkModifier($item->get('title')) }}</a>
                        <span class="sitebit comhead">
                            (<a href=""><span class="sitestr">{{\trademarkModifier(\Illuminate\Support\Str::after(\parse_url($item->get('url'))['host'] ?? '', 'www.'))}}</span></a>)
                        </span>
                    </span>
                </td>
            </tr>
            <tr>
                <td colspan="2"></td>
                <td class="subtext">
                    <span class="subline">
                        <span class="score" id="{{\trademarkModifier("score_" . $item->get('id'))}}">{{ \trademarkModifier($item->get('score')) }} points</span> by <a href="" class="hnuser">{{ \trademarkModifier($item->get('by'))  }}</a>
                        <span class="age" title={{ (string) $time  }}>
                            <a href="item?id={{\trademarkModifier($item->get('id'))}}">
                                {{ (static function() use ($time) {
                        /** @var Carbon\Carbon $diff */
                        $diff = $time->diff(now());

                        /** @var array */
                        $diffData = [
                            [$diff->y, 'years ago.'],
                            [$diff->m, 'month ago.'],
                            [$diff->d, 'days ago.'],
                            [$diff->h, 'hours ago.'],
                            [$diff->i, 'minutes ago.'],
                            [$diff->s, 'seconds ago'],
                        ];

                        return \implode(' ', \Illuminate\Support\Arr::first($diffData, (static function ($data) {
                            return \current($data) !== 0;
                        })));

                    })() }}
                            </a>
                        </span>
                        <span id={{ \trademarkModifier('unv_' . $item->get('id')) }}>
                            <a href="item?id={{\trademarkModifier($item->get('id'))}}">{{ \trademarkModifier($item->get('descendants')) }} comments</a>
                        </span>
                    </span>
                </td>
            </tr>
            <tr style="height:10px"></tr>


            <tr>
                <td colspan="2"></td>
                <td>
                    <form action="/item?={{$item->get('id')}}" method="GET">
                        <textarea name="text" rows="8" cols="80" wrap="virtual"></textarea>
                        <br><br>
                        {{ \trademarkModifier("If you haven't already, would you mind reading about HN's") }}
                        <a href=""><u>{{ \trademarkModifier("approach to comments")}}</u></a> and
                        <a href=""><u>{{\trademarkModifier('site guidelines')}}</u></a>?<br><br>
                        <input type="submit" value="add comment"></form></td>
            </tr>

            </tbody>
        </table>

        <br><br>

        <table class="comment-tree" border="0">
            <tbody>
                @include('templates/nested/kid', ['item' => $item, 'isParent' => true])
            </tbody>
        </table>
    </td>
</tr>

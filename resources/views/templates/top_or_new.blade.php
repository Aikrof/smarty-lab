@php
    /** @var \Carbon\Carbon $time */
    $time = \Carbon\Carbon::createFromTimestamp($item->get('time'));

@endphp

<tr class="athing" id="36116777">
    <td class="title" valign="top" align="right"><span class="rank">{{ \trademarkModifier($runk) }}.</span></td>
    <td class="votelinks" valign="top">
        <center>
            <a id="up_36116777" href="vote?id=36116777&amp;how=up&amp;goto=news">
                <div class="votearrow" title="upvote"></div>
            </a>
        </center>
    </td>
    <td class="title">
        <span class="titleline">
            <a href="item?id={{$item->get('id')}}">{{ \trademarkModifier($item->get('title')) }}</a>
            <span class="sitebit comhead"> (<a href={{\url()->current()}}><span class="sitestr">
                        {{\trademarkModifier(\Illuminate\Support\Str::after(\parse_url($item->get('url'))['host'] ?? '', 'www.'))}}
                    </span></a>)</span>
        </span>
    </td>
</tr>
<tr>
    <td colspan="2"></td>
    <td class="subtext">
        <span class="subline">
          <span class="score" id="score_{{$item->get('id')}}">{{ \trademarkModifier($item->get('score')) }} points</span> by <a href="" class="hnuser">{{ \trademarkModifier($item->get('by')) }}</a>
            <span class="age" title="{{ \trademarkModifier((string) $time) }}">
                <a href="item?id={{$item->get('id')}}">
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
            <span id="unv_36116777"></span> | <a href="item?id={{$item->get('id')}}">{{ \trademarkModifier($item->get('descendants')) }}&nbsp;comments</a>
        </span>
    </td>
</tr>
<tr class="spacer" style="height:5px"></tr>

@php
    /** @var \Carbon\Carbon $time */
    $time = \Carbon\Carbon::createFromTimestamp($item->get('time'));
@endphp

<tr class="athing" id="36120745">
    <td class="title" valign="top" align="right">
        <span class="rank">{{ $runk }}.</span>
    </td>
    <td class="votelinks" valign="top">
        <center>
            <a id="up_{{$item->get('id')}}" class="clicky" href="vote?id=36120745&amp;how=up&amp;auth=7aea6a27d275c7e4904e391b3c807e6e32779569&amp;goto=ask">
                <div class="votearrow" title="upvote"></div>
            </a>
        </center>
    </td>
    <td class="title">
        <span class="titleline">
            <a href="item?id={{$item->get('id')}}">{{ \trademarkModifier(\trim($item->get('title'), '?')) }}?</a>
        </span>
    </td>
</tr>
<tr>
    <td colspan="2"></td>
    <td class="subtext">
        <span class="subline">
          <span class="score" id="score_{{ \trademarkModifier($item->get('id')) }}">{{ \trademarkModifier($item->get('score')) }} points</span> by <a href="" class="hnuser">{{ \trademarkModifier($item->get('by')) }}</a>
            <span class="age" title="{{\trademarkModifier((string) $time)}}">
                <a href="item?id={{$item->get('id')}}">{{ (static function() use ($time) {
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

                    })() }}</a></span>
            <span id="unv_36120745"></span>
            | <a href="item?id=36120745">discuss</a>
            | <a href="item?id=36113331">{{ \trademarkModifier($item->get('descendants')) }} comments</a>
        </span>
    </td>
</tr>
<tr class="spacer" style="height:5px"></tr>

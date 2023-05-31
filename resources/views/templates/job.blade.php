@php
    /** @var \Carbon\Carbon $time */
    $time = \Carbon\Carbon::createFromTimestamp($item->get('time'));
@endphp

<tr class="athing" id="36123766">
    <td class="title" valign="top" align="right">
        <span class="rank"></span>
    </td>
    <td>
        <img src="s.gif" width="14" height="1">
    </td>
    <td class="title">
        <span class="titleline">
            <a href="" rel="nofollow">
                {{ \trademarkModifier($item->get('title')) }}
            </a>
            <span class="sitebit comhead">
                (<a href=""><span class="sitestr"> {{\trademarkModifier(\Illuminate\Support\Str::after(\parse_url($item->get('url'))['host'] ?? '', 'www.'))}} </span></a>)
            </span>
        </span>
    </td>
</tr>
<tr>
    <td colspan="2"></td>
    <td class="subtext">
        <span class="age" title="{{(string) $time}}">
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
    </td>
</tr>
<tr class="spacer" style="height:5px"></tr>

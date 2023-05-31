@php

    /**
    * @var bool $isParent
    */
    $isParent = $isParent ?? true;

    /**
    *  Nested level
    *
    * @var int $level
    */
    $level = ($isParent === false && isset($currentLevel)) ? ++$currentLevel : 0;

    /** @var array $kidsData */
    $kidsData = !empty($item->get('kids'))
        ? \app()->make(\App\Wrappers\Hackernews\HackerNewsManagerInterface::class)
            ->item()
            ->getItem($item->get('kids'))
        : [];
@endphp

@foreach($kidsData as $data)
    @php
        /** @var \Illuminate\Support\Collection $kid */
        $kid = new \Illuminate\Support\Collection($data);
        /** @var \Carbon\Carbon $time */
        $kidTime = \Carbon\Carbon::createFromTimestamp($kid->get('time'));

    @endphp
    <tr class="athing comtr" id={{\trademarkModifier($kid->get('id'))}}>
        <td>
            <table border="0">
                <tbody>
                <tr>
                    <td class="ind" indent="{{$level}}">
                        <img src="s.gif" width="{{$level * 40}}" height="1">
                    </td>
                    <td class="votelinks" valign="top">
                        <center>
                            <a id="up_{{\trademarkModifier($kid->get('id'))}}" class="clicky">
                                <div class="votearrow" title="upvote"></div>
                            </a>
                        </center>
                    </td>
                    <td class="default">
                        <div style="margin-top:2px; margin-bottom:-10px;">
                                    <span class="comhead">
                                        <a href="" class="hnuser">{{\trademarkModifier($kid->get('by'))}}</a>
                                        <span class="age" title="{{(string) $kidTime}}">
                                            <a href="item?id={{\trademarkModifier($kid->get('id'))}}">{{\diffTimeAgo($kidTime)}}</a></span>
                                        <span id="unv_{{\trademarkModifier($kid->get('id'))}}"></span>
                                        <span class="navs">
                                            | <a href="#{{$kid->get('id')}}" class="clicky" aria-hidden="true">next</a>
                                            <a class="togg clicky" id="{{$kid->get('id')}}" n="33" href="javascript:void(0)">[–]</a>
                                            <span class="onstory"></span>
                                        </span>
                                    </span>
                        </div>
                        <br>
                        <div class="comment">
                                    <span class="commtext c00">@php echo \trademarkModifier($kid->get('text')) @endphp
                                        <div class="reply">
                                            <p>
                                                <font size="1">
                                                    <u>
                                                        <a href="reply?id=36128201&amp;goto=item%3Fid%3D36127800%2336128201">reply</a>
                                                    </u>
                                                </font>
                                            </p>
                                        </div>
                                    </span>
                        </div>
                    </td>
                </tr>
                </tbody>
            </table>
        </td>
    </tr>
    @php

 @endphp

    @includeWhen(
        !empty($kid->get('kids')),
        "templates/nested/kid",
        ['item' => $kid, 'isParent' => false, 'currentLevel' => $level]
    )
@endforeach

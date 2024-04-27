@if (count($content->comments))
<div class="rate  ">

    @if (count($content->comments))
    @php
    $rateAvrage = $rateSum = 0;
    @endphp
    @foreach ($content->comments as $comment)
    @php
    $rateSum = $rateSum + $comment['rate'];
    @endphp
    @endforeach

    @for ($i = $rateSum / count($content->comments); $i >= 1; $i--)
    <label></label>
    @endfor
    @endif
</div>
@endif

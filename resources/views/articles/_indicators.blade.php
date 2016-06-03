@if($indicator == 0)
	<li data-target="#carousel{{$name}}" data-slide-to="{{$indicator}}" class="active"></li>
@else
	<li data-target="#carousel{{$name}}" data-slide-to="{{$indicator}}"></li>
@endif
@extends('layout')

@section('content')
<div class="list-item-group">
    @foreach($items as $item)
    <a class="list-item" href="{{$item->id}}">{{ Arr::get($item, 'suffix.display_name') }}</a>
    @endforeach
</div>
@endsection

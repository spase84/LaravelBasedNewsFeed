@extends('layout')

@section('content')

  <ul class="list">
    @foreach($collection as $item)
      <li>
        <a href="/news/{{$item->id}}/">
          <span class="date">{{date('d M Y', strtotime($item->created_at))}}</span>{{ $item->title }}
        </a>
      </li>
    @endforeach
  </ul>
@stop
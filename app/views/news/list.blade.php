@extends('layout')

@section('content')

  <a href="{{URL::to('/news/create/')}}" class="btn btn-primary"><i class="fa fa-plus"></i> Добавить</a>

  <ul class="list">
    @foreach($collection as $item)
      <li>
        <span class="date">{{date('d M Y', strtotime($item->created_at))}}</span>
        <a href="/news/{{$item->id}}/">
          {{ $item->title }}
        </a>
      </li>
    @endforeach
  </ul>

  <a href="{{URL::to('/news/create/')}}" class="btn btn-primary"><i class="fa fa-plus"></i> Добавить</a>
@stop
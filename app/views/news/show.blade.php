@extends('layout')

@section('content')

  <div class="breadcrumbs">
    <a href="{{URL::to('/')}}"><i class="fa fa-long-arrow-left"></i> Все новости</a>
  </div>

  <div class="resource">
    <h3><span class="date">{{date('d M Y', strtotime($resource->created_at))}}</span> {{$resource->title}}</h3>
    <div class="body">{{$resource->body}}</div>
    @if ($resource->updated_at > $resource->created_at)
      <div class="updated">Обновлено: {{date('d M Y H:i', strtotime($resource->updated_at))}}</div>
    @endif

    <div class="actions">
      <a href="{{URL::route('edit', array('id' => $resource->id))}}" class="btn btn-warning btn-sm">Редактировать</a>
      <a href="{{URL::route('delete', array('id' => $resource->id))}}" class="btn btn-danger btn-sm">Удалить</a>
    </div>
  </div>

@stop
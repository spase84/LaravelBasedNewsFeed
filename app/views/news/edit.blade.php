@extends('layout')

@section('content')

<div class="breadcrumbs">
  <a href="{{URL::to('/')}}"><i class="fa fa-long-arrow-left"></i> Все новости</a>
</div>

<div class="resource">
  <h3>{{$resource->title}} <span class="date">Редактирование</span></h3>

  @include('news.form', compact('resource'))

  <div class="clearfix"></div>
</div>

@stop
<form action="{{URL::to('/news/create/')}}" method="post" role="form" class="form col-md-9">

  @if ($resource->id)
  <input type="hidden" name="news[id]" value="{{$resource->id}}" />
  @endif

  <div class="form-group">
    <label for="news_title" class="control-label">Название</label>
    <input type="text" id="news_title" name="news[title]" value="{{$resource->title}}" class="form-control" />
  </div>

  <div class="form-group">
    <label for="news_body" class="control-label">Текст</label>
    <textarea rows="5" id="news_body" name="news[body]" class="form-control">{{{$resource->body}}}</textarea>
  </div>

  @if ($resource->updated_at > $resource->created_at)
  <div class="updated">Обновлено: {{date('d M Y H:i', strtotime($resource->updated_at))}}</div>
  @endif

  <div class="form-group">
    <button type="submit" class="btn btn-success">Сохранить</button>
  </div>
</form>
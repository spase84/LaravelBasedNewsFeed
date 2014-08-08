<?php

class NewsController extends BaseController {

	public function show($id = 0)
	{
    $resource = News::find($id);
		return View::make('news.show', compact('resource'));
	}

  public function edit($id = 0)
  {
    $resource = News::find($id);
    return View::make('news.edit', compact('resource'));
  }

  public function create() {
    if (Input::has('news')) {
      $data = Input::get('news');

      $resource = News::firstOrNew(array('id' => isset($data['id']) ? (int) $data['id'] : 0));
      unset($data['id']);
      $resource->updated_at = time();
      $resource->title = $data['title'];
      $resource->body = $data['body'];

      if (!$resource->id) {
        $resource->created_at = time();
      }


      if ($resource->save()) {
        return Redirect::to('/')->with('message', 'Новость сохранена');
      }
    } else {
      $resource = new News;
    }

    return View::make('news.create', compact('resource'));
  }


  public function delete($id = 0) {
    if (News::destroy((int) $id)) {
      return Redirect::to('/')->with('message', 'Новость удалена');
    }
  }

}

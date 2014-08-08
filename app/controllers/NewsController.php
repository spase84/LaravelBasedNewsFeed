<?php

class NewsController extends BaseController {

  public $_model;

  public function __construct()
  {
    $this->beforeFilter('@filterDataSource');
  }


  public function filterDataSource($route, $request)
  {
    switch(Config::get('app.newsStorage')) {
      default:
      case 'mysql':
        $this->_model = 'News';
        break;
      case 'file':
        $this->_model = 'NewsFile';
        break;
    }
  }

  public function show($id)
  {
    $model = $this->_model;
    $resource = $model::find($id);
    return View::make('news.show', compact('resource'));
  }

  public function edit($id = 0)
  {
    $model = $this->_model;
    $resource = $model::find($id);
    return View::make('news.edit', compact('resource'));
  }

  public function create() {
    $model = $this->_model;
    if (Input::has('news')) {
      $data = Input::get('news');

      $resource = $model::firstOrNew(array('id' => isset($data['id']) ? (int) $data['id'] : 0));
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

      $resource = new $model;
    }

    return View::make('news.create', compact('resource'));
  }


  public function delete($id = 0) {
    $model = $this->_model;
    if ($model::destroy((int) $id)) {
      return Redirect::to('/')->with('message', 'Новость удалена');
    }
  }

}

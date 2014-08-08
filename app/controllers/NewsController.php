<?php

namespace App\Controllers;

use View;
use Input;
use Redirect;
use Carbon\Carbon;
use \App\Controllers\BaseController;

class NewsController extends BaseController {

  public function index() {
    $collection = $this->_db->all();
    return View::make('news.list', compact('collection'));
  }

  public function show($id)
  {
    $resource = $this->_db->find($id);
    return View::make('news.show', compact('resource'));
  }

  public function edit($id = 0)
  {
    $resource = $this->_db->find($id);
    return View::make('news.edit', compact('resource'));
  }

  public function create() {
    $resource = $this->_db;
    if (Input::has('news')) {
      $data = Input::get('news');

      if (isset($data['id']) and (int) $data['id'] > 0) {
        $resource = $this->_db->find($data['id']);
      }

      $resource->title = $data['title'];
      $resource->body = $data['body'];

      if ($this->_db->save($resource)) {
        return Redirect::to('/')->with('message', 'Новость сохранена');
      }
    }

    return View::make('news.create', compact('resource'));
  }


  public function delete($id = 0) {
    if ($this->_db->destroy((int) $id)) {
      return Redirect::to('/')->with('message', 'Новость удалена');
    }
  }

}

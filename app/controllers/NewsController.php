<?php

class NewsController extends BaseController {

	public function show($id)
	{
    $resource = News::find($id);
		return View::make('news.show', compact('resource'));
	}

  public function edit($id)
  {
    $resource = News::find($id);

    return View::make('news.edit', compact('resource'));
  }

}

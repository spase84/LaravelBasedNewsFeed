<?php

namespace App\Controllers;

use Illuminate\Routing\Controller;
use View;
use Config;

class BaseController extends Controller {

  protected $_db;

  public function __construct()
  {
    $this->beforeFilter('@filterDataSource');
  }


  public function filterDataSource($route, $request)
  {
    switch(Config::get('app.newsStorage')) {
      case 'file':
        $this->_db = new \App\Models\NewsFile;
        break;
      default:
      case 'mysql':
        $this->_db = new \App\Models\NewsDb;
        break;
    }
  }


	protected function setupLayout()
	{
		if ( ! is_null($this->layout))
		{
			$this->layout = View::make($this->layout);
		}
	}

}

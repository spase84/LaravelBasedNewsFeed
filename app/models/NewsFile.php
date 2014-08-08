<?php

namespace App\Models;

use App\Models\Database;
use Carbon\Carbon;
use Config;
use CSV;

class NewsFile extends Database {

  public $_file;

  public function __construct() {
    $fileName = Config::get('app.storageFile');
    $this->_file = storage_path() . DIRECTORY_SEPARATOR . 'data' . DIRECTORY_SEPARATOR . $fileName . '.csv';

    $this->updated_at = Carbon::now();
    $this->created_at = Carbon::now();
  }

  public function all() {
    return array_map(function($a) {return (object) $a;}, CSV::fromFile($this->_file)->toArray());
  }

  public function find($id) {
    $data = CSV::fromFile($this->_file)->toArray();

    $IDs = array_map(function ($a) {return $a['id'];}, $data); // $key => 'id'
    if (false !== $key = array_search($id, $IDs))
      return (object) $data[$key];

    return null;
  }

  public function save($object) {

    // If new record
    if (null === $object->id) {
      $object->id = $this->getLastInsetredId() + 1;
    }

    $arObj = (array) $object;
    unset($arObj['_file']);


    $all = CSV::fromFile($this->_file)->toArray();
    if (null !== $this->find($arObj['id'])) {
      $arObj['updated_at'] = Carbon::now();

      $IDs = array_map(function ($a) {return $a['id'];}, $all); // $key => 'id'
      if (false !== $key = array_search($arObj['id'], $IDs))
      $all[$key] = $arObj;

    } else {
      $all[] = $arObj;
    }

    CSV::with($all)->put($this->_file);
    return true;
  }

  public function destroy($id) {
    $all = CSV::fromFile($this->_file)->toArray();

    $IDs = array_map(function ($a) {return $a['id'];}, $all); // $key => 'id'
    if (false !== $key = array_search($id, $IDs)) {
      unset($all[$key]);
    }

    CSV::with($all)->put($this->_file);
    return true;
  }











  private function getLastInsetredId() {
    $IDs = array_map(function($a) {return $a['id'];}, CSV::fromFile($this->_file)->toArray()); // $key => 'id'

    return max(array_values($IDs));
  }

}
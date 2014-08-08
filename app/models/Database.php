<?php

namespace App\Models;

abstract class Database {

  public $id;
  public $title;
  public $body;
  public $created_at;
  public $updated_at;
  public $_file;

  abstract protected function all();

  abstract protected function find($id);

  abstract protected function save($object);

  abstract protected function destroy($id);
}
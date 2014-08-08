<?php

namespace App\Models;

use App\Models\Database;
use Carbon\Carbon;
use DB;

class NewsDb extends Database {

  public function __construct() {
    $this->updated_at = Carbon::now();
    $this->created_at = Carbon::now();
    unset($this->_file);
  }

  public function find($id) {
    return DB::table('news')->where('id', (int) $id)->first();
  }

  public function all() {
    return DB::table('news')->get();
  }

  public function save($object) {
    if ($object->id)
      $object->updated_at = Carbon::now();


    if ($object->id) {
      return DB::table('news')->where('id', (int) $object->id)
        ->update((array) $object);
    } else {
      return DB::table('news')->insert((array) $object);
    }
  }

  public function destroy($id) {
    return DB::table('news')->where('id', (int) $id)->delete();
  }
}
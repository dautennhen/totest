<?php

namespace App\Repositories;

use Artisan;

class BackupRepository {

    public function __construct() {
        
    }

    public function listBuilder() {
        return \Storage::allFiles('backups');
    }

    public function getItems($data = []) {
        return $this->listBuilder();
    }

    public function getListJson($data) {
        return $this->listBuilder()->toJson();
    }

    // Ajax
    public function destroy($filename) {
        return \File::delete($filename);
    }

    public function store() {
        return Artisan::call('backup:run --only-db');
    }

}

<?php

namespace App\Repositories;

use App\Models\approvers;


class ApproversRepository {
    public function create(array $data){
        return approvers::create($data);
    }
}
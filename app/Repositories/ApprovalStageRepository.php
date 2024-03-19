<?php

namespace App\Repositories;

use App\Models\approval_stages;


class ApprovalStageRepository {
    public function create(array $data){
        return approval_stages::create($data);
    }
    public function update($id, array $data){
        $check = approval_stages::find($id);
        if(is_null($check)){
            throw new \Exception('Approval Stage Id is not found');
        }
        $check->update($data);
        return $check;
    }
}
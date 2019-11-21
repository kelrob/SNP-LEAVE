<?php

namespace App\Models\LeaveRequest;

use Illuminate\Database\Eloquent\Model;

class LeaveRequestModel extends Model
{
    protected $table = 'leave_request';
    protected $primaryKey = 'id';

    public function LineManager() {
        return $this->hasMany('App\Models\LeaveRequest\LineManagerModel');
    }
}

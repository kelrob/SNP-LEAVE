<?php

namespace App\Http\Controllers\Accounts;

use App\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Models\Users;
use Sentinel;
use App\Models\LeaveRequest\LeaveRequestModel;
class employeeController extends Controller
{
    public function employee() {

        
        $user = Sentinel::getUser();
        $pendingRequest = LeaveRequestModel::where('user_id', '=', $user->id)
                                            ->where('status', '=', 0);

        $pendingRequestCount = $pendingRequest->count();

        $data = [
            'name' => $user->name,
            'days_left' => $user->days_left,
            'request_count' => $pendingRequestCount
        ];

        return view('dashboard.employee', compact('data'));
    }
}

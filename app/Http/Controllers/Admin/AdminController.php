<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\BaseController;
use Illuminate\Support\Facades\Hash;
use App\Models\Admin;
use Illuminate\Http\Request;

class AdminController extends BaseController
{

    /**
    * @return admin value
    */
    public function showProfile(){
    	\Log::info("Req=AdminController@showProfile called");
    	$this->setPageTitle('Admin', 'Profile Details');
    	return view('admin.auth.adminprofile');
    }


    public function updateProfile(Request $request){
        \Log::info("Req=AdminController@updateProfile called");
        $this->validate($request, [
            'password' => 'confirmed',
        ]);

        $data = $request->except('_token', 'id');
        $password;
        $user = Admin::findOrFail($request['id']);

        if($request->password != null)
        {
            $password = Hash::make($request->password);
            $data["password"] = $password;
        }else{
            $password=$user->password;
            $data["password"] = $password;
        }
        $user->update($data);

        if(!$user){
			return $this->responseRedirectBack('Error occurred while updating Profile', 'error', true, true);
		}

		return $this->responseRedirect('admin.profile', 'Profile has been updated successfully', 'success');
    }
}

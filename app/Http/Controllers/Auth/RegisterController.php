<?php
namespace App\Http\Controllers\Auth;

use App\Models\User;
use App\Models\UserAddress;
use App\Models\Country;
use App\Models\States;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use Illuminate\Foundation\Auth\RegistersUsers;

class RegisterController extends Controller{

	use RegistersUsers;

	protected $redirectTo = '/';

	public function __construct(){
		$this->middleware('guest');
	}

	public function validator(Array $data){
		return Validator::make($data, [
			'first_name'	=> ['required', 'string', 'max:255'],
			'last_name'		=> ['required', 'string', 'max:255'],
			'email'			=> ['required', 'string', 'email', 'max:255', 'unique:users'],
			'password'		=> ['required', 'string', 'min:8', 'confirmed'],
			'zip_code'		=> ['required', 'string'],
			'country'		=> ['required', 'string'],
			'address'		=> ['required', 'string', 'max:255'],
			'state'		=> ['required', 'string'],
			'city'		=> ['required', 'string', 'max:255'],
		]);
	}


	public function create(array $data){
		$user = User::create([
			'email'			=> $data['email'],
			'password'		=> Hash::make($data['password']),
		]);

		$address = new UserAddress([
			'user_id' => $user->id,
			'first_name' => $data['first_name'],
			'last_name' => $data['last_name'],
			'phone' => $data['phone'],
			'address' => $data['address'],
			'addressline2' => $data['addressline2'],
			'city' => $data['city'],
			'state' => $data['state'],
			'zip_code' => $data['zip_code'],
			'country' => $data['country'],
		]);

		$user->address()->save($address);
		return $user;
	}


	public function fetechCountryStates(Request $request){
		$country = Country::findOrFail($request->id);
		return json_encode($country->states);
	}

}
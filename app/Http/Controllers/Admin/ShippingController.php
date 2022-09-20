<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\BaseController;
use Illuminate\Http\Request;
use App\Contracts\BrandContract;
use App\Models\ShippingCountry;
use App\Models\ShippingRule;
use App\Models\Country;

class ShippingController extends BaseController
{
	
	public function __construct(){
		

	}
	public function index(){
		\Log::info("Req=ShippingController@index called");
		$this->setPageTitle('Shipping', 'Shipping Countries');
		$shippingCountries = ShippingCountry::all();
		$countries = Country::all();
		return view('admin.shippings.index',compact('shippingCountries','countries'));
	}

	public function addCountry(Request $request){
		\Log::info("Req=ShippingController@addCountry called");
		$country = Country::findOrFail($request->country_id);
		$ship_country = new ShippingCountry([
			'code'=>$country->code,
			'name'=>$country->name,
			'shipping_status'=>1
		]);

		if(!$ship_country->save()){
			return $this->responseRedirectBack('Error occured while adding country', 'error', true, true);		
		}

		return $this->responseRedirect('admin.shipping.index', 'Country added successfully.', 'success');
	}

	public function upadeCountryStatus(Request $request){
		\Log::info("Req=ShippingController@updateCountryStatus called");
		$country = ShippingCountry::findOrFail($request->country_id);
		$country->shipping_status = $request->status;
		if($country->save()){
			return json_encode(['request_status'=>'success','message'=>$country->name.' Status Updated Successfully.']);
		}
		return json_encode(['request_status'=>'fail','message'=>$country->name.' Status Update Failed.']);
	}


	public function deleteShippingCountry($id){
		\Log::info("Req=ShippingController@deleteShippingCountry called");

		$deleteShippingCountry = ShippingCountry::findOrFail($id);

		if(!$deleteShippingCountry->delete()){
			return $this->responseRedirectBack('Error occured while deleting shipping country', 'error', true, true);
		}

		return $this->responseRedirect('admin.shipping.index', 'Shipping country has been deleted successfully', 'success');
	}


	public function shippinRules($id){
		\Log::info("Req=ShippingController@shippinRules called");
		$shippingCountry = ShippingCountry::findOrFail($id);
		$this->setPageTitle($shippingCountry->name, 'Shipping Rules');
		$shippingRules = $shippingCountry->rules;
		$country_id = $id;
		return view('admin.shippingrules.index', compact('shippingRules','country_id'));
	}

	public function addRule(Request $request){
		\Log::info("Req=ShippingController@addRule called");
		$rule = new ShippingRule([
			'shipping_country_id'=>$request->country_id,
			'min_weight'=>$request->min_weight,
			'max_weight'=>$request->max_weight,
			'shipping_amount'=>$request->shipping_amount,
			'status'=>1
		]);

		if(!$rule->save()){
			return $this->responseRedirectBack('Error occured while adding rule', 'error', true, true);		
		}
		return $this->responseRedirectBack('Rule added successfully.', 'success');
	}

	public function deleteShippingRule($id){
		\Log::info("Req=ShippingController@deleteShippingRule called");

		$deleteShippingRule = ShippingRule::findOrFail($id);

		if(!$deleteShippingRule->delete()){
			return $this->responseRedirectBack('Error occured while deleting shipping rule', 'error', true, true);
		}

		return $this->responseRedirectBack('Shipping rule has been deleted successfully', 'success');
	}


	public function upadeRuleStatus(Request $request){
		\Log::info("Req=ShippingController@updateRuleStatus called");
		$rule = ShippingRule::findOrFail($request->rule_id);
		$rule->status = $request->status;
		if($rule->save()){
			return json_encode(['request_status'=>'success','message'=> 'Status Updated Successfully.']);
		}
		return json_encode(['request_status'=>'fail','message'=> 'Status Update Failed.']);
	}

	public function getRuleData(Request $request){
		\Log::info("Req=ShippingController@getRuleData called");
		return json_encode(ShippingRule::findOrFail($request->rule_id));
	}

	public function updateRuleData(Request $request){
		\Log::info("Req=ShippingController@updateRuleData called");
		
		$rule = ShippingRule::findOrFail($request->rule_id);
		$rule->min_weight = $request->min_weight;
		$rule->max_weight = $request->max_weight;
		$rule->shipping_amount = $request->shipping_amount;

		if($rule->save()){
			return json_encode(['request_status'=>'success','message'=> 'Rule Updated Successfully.']);
		}
		return json_encode(['request_status'=>'fail','message'=> 'Rule Update Failed.']);
	}
}



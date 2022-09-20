<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Models\AttributeValue;
use App\Models\ProductAttribute;
use App\Http\Controllers\Controller;
use App\Contracts\AttributeContract;

class AttributeValueController extends Controller
{
	protected $attributeRepository;

	public function __construct(AttributeContract $attributeRepository)
	{
		\Log::info("Req=AttributeValueController@__construct called");

		$this->attributeRepository = $attributeRepository;
	}

	public function getValues(Request $request)
	{
		\Log::info("Req=AttributeValueController@getValues called");

		$attributeId = $request->input('id');
		$attribute = $this->attributeRepository->findAttributeById($attributeId);

		$values = $attribute->values;

		return response()->json($values);
	}

	public function addValues(Request $request)
	{	
		\Log::info("Req=AttributeValueController@addValues called");
		$value = new AttributeValue();
		$value->attribute_id = $request->input('id');
		$value->value = $request->input('value');
		$value->price = $request->input('price');
		$value->save();

		return response()->json($value);
	}

	public function updateValues(Request $request)
	{
		\Log::info("Req=AttributeValueController@updateValues called");	
		$attributeValue = AttributeValue::findOrFail($request->input('valueId'));
		$productAttr = ProductAttribute::where([['attribute_id',$attributeValue->attribute_id],['value',$attributeValue->value]])->firstOrFail();
		$productAttr->value = $request->input('value');
		$productAttr->price = $request->input('price');
		$attributeValue->attribute_id = $request->input('id');
		$attributeValue->value = $request->input('value');
		$attributeValue->price = $request->input('price');
		$productAttr->save();
		$attributeValue->save();

		return response()->json($attributeValue);
	}

	public function deleteValues(Request $request)
	{
		$attributeValue = AttributeValue::findOrFail($request->input('id'));
		$attributeValue->delete();

		return response()->json(['status' => 'success', 'message' => 'Attribute value deleted successfully.']);
	}
}
<?php
namespace App\Traits;

trait Responser{
		
	protected function data($data){
		return response()->json([
			'response_code' => 200,
			'response_msg' => 'Success',
			'data'=> $data
		], 200);		
	}

	protected function referenceNumbepr($referenceNumber){
		return response()->json([
			'response_code' => 200,
			'response_msg' => 'Success',
			'reference_number' => $referenceNumber
		], 200);
	}

	protected function unknowError($message){
		return response()->json([
			'response_code' => 500,
			'response_msg' => $message
		], 500);
	}
	
	protected function unauthenticated(){
		return response()->json([
			'response_code' => 401,
			'response_msg' => 'Unaunthenticated',
		], 401);
	}

	protected function invalidCustom($code, $message){
		return response()->json([
			'response_code' => $code,
			'response_msg' => $message,
		], $code);
	}

	protected function invalidUrl(){
		return response()->json([
			'response_code' => 404,
			'response_msg' => 'Invalid request url',
		], 404);
	}

	protected function invalidMethod(){
		return response()->json([
			'response_code' => 405,
			'response_msg' => 'Invalid request method',
		], 405);
	}

	protected function invalidDataInput($errors) {
		return response ()->json ( [
			'response_code' => 422,
			'response_msg' => 'Invalid data input',
			'errors' => $errors,
		], 422);
	}
}
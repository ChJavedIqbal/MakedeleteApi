<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Device;
use Validator;
use mysql_xdevapi\Result;

class DeviceController extends Controller
{
    function delete($id){
        $device = Device::find($id);
        $result = $device->delete();
        if($result){
            return ["result"=>"record has been deleted successfully"];

        }
        else{
            return ["result"=>"operation failed"];

        }
    }
    function search($name){
        return Device::where("name","like","%".$name."%")->get();
    }
    function testData(Request $req)
    {
        $rules = array(
          "member_id"=>"required | max:4",
            "name"=>"required"

        );
        $validator=Validator::make($req->all(),$rules);
        if($validator->fails()){
            return response()->json($validator->errors(),401);
        }
        else{
                $device = new Device;
                $device->name=$req->name;
                $device->member_id=$req->member_id;
                 $result=$device->save();
                 if($result){
                     return ['Result'=>"data has been saved"];
                 }
                 else{
                     return ['Result'=>"Operation failed"];

                 }


        }
    }
}

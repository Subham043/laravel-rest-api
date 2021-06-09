<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Device;
use Illuminate\Support\Facades\Validator;

class DeviceController extends Controller
{
    public function lists(){
        return Device::all();
    }

    public function list($id){
        return Device::find($id);
    }

    public function add_list(Request $req){
        $device = new Device;
        $device->name = $req->name;
        $device->email = $req->email;
        $result = $device->save();
        if($result){
            return [
                "success" => "Operation Succesful"
            ];
        }else{
            return [
                "error" => "Operation Failed"
            ];
        }
    }

    public function update_list($id, Request $req){
        $device = Device::find($id);
        $device->name = $req->name;
        $device->email = $req->email;
        $result = $device->save();
        if($result){
            return [
                "success" => "Operation Succesful"
            ];
        }else{
            return [
                "error" => "Operation Failed"
            ];
        }
    }

    public function delete_list($id){
        $device = Device::find($id);
        $result = $device->delete();
        if($result){
            return [
                "success" => "Operation Succesful"
            ];
        }else{
            return [
                "error" => "Operation Failed"
            ];
        }
    }

    public function search_list($name){
        return Device::where("name", $name)->get();
    }

    public function save_list(Request $req){
        $rules = array(
            "name" => "required|min:3|max:10",
            "email" => "required"
        );
        $validator = Validator::make($req->all(), $rules);
        if($validator->fails()){
            return $validator->errors();
        }else{
            $device = new Device;
            $device->name = $req->name;
            $device->email = $req->email;
            $result = $device->save();
            if($result){
                return [
                    "success" => "Operation Succesful"
                ];
            }else{
                return [
                    "error" => "Operation Failed"
                ];
            }
        }
        
    }

    public function new_lists(){
        return Device::all();
    }

    public function upload(Request $req){
        $result = $req->file('file')->store('images');
        return[
            "status" => "uploaded"
        ];
    }

}

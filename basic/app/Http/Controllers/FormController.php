<?php

namespace App\Http\Controllers;

use App\Item;
use Illuminate\Http\Request;

class FormController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth')->except(['create','store']);
        $this->middleware('isMe')->only(['create']);
    }

    public function create(){
        return view("request-response.form");
    }

    public function store(Request $request){

        $request->validate([
            "name" => "required|min:3|max:50",
            "price" => "required|integer|min:1|max:100000",
            "stock" => "required|integer|min:1|max:10",
        ]);

        $item = new Item();
        $item->name = $request->name;
        $item->price = $request->price;
        $item->stock = $request->stock;
        $item->save();


        return redirect()->route("form.create")->with("status",$request->name." is added");


    }

    public function destroy($id){
        $currentItem = Item::find($id);
        $currentItemName = $currentItem->name;
        $currentItem->delete();
        return redirect()->route("form.create")->with("deleteStatus",$currentItemName." is deleted");
    }

    public function edit($id){
        $currentItem = Item::find($id);

        return view("request-response.edit",compact('currentItem'));
    }

    public function update($id,Request $request){
        $currentItem = Item::find($id);
        $currentItem->name = $request->name;
        $currentItem->price = $request->price;
        $currentItem->stock = $request->stock;
        $currentItem->update();
        return redirect()->route("form.create")->with("deleteStatus",$request->name." is updated");

    }

    public function updateMultiple(){

        $current_item = 1;
        $currentItem = 1;

    }

}

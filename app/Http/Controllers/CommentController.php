<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ProductComment;
use Illuminate\Support\Facades\Auth;

class CommentController extends Controller
{

    public function client_store(Request $request) {

        $request->validate([
            'product_id' => 'required',
            'rating'     => 'required',
            'content'    => 'required'
        ]);

        ProductComment::create([
            "user_id"    => Auth::id(),
            "product_id" => $request["product_id"],
            "rating"     => $request["rating"],
            "content"    => $request["content"],
        ]);

        session()->flash("success", "Comment is created succesfully.");
        return back();
    }

    public function destroy(ProductComment $product_comment) {
        $product_comment->delete();
        session()->flash("success", "Comment is deleted succesfully.");
        return back();
    }
}

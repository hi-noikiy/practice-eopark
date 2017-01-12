<?php
namespace App\Http\Controllers;

use App\Repositories\Models\FeedbackModel;
use App\Repositories\Models\ResourcesModel;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Redirect;

class FeedbackController extends Controller {

    public function invalid($resourceId) {
        ResourcesModel::where('id', $resourceId)->update(['feedback_invalid' => 1]);
    }

    public function opinion() {
        $userId = valueOr(Auth::id());
        $result = FeedbackModel::create([
            'user_id' => $userId,
            'opinion' => Input::get("opinion"),
            'url' => valueOr(Input::get("url"), ''),
        ]);
        setReturnMessage($result);
        return Redirect::back();
    }

}
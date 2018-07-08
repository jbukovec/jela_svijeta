<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Language;
use App\Meal;
use App\Http\Resources\Meal as MealResource;
use Illuminate\Support\Carbon;

class MealController extends Controller
{
    public function show_meals(Request $request)
    {   
        if(! empty($request->lang)){
            if(! Language::where('language', $request->lang)->exists()){
                return response()->json(['error' => 'jezik prijevoda ne postoji']);
            }
        }
        else{
            return response()->json(['error' => 'niste odabrali jezik prijevoda']);
        }
        app()->setLocale($request->lang);

        $meals = Meal::query();

        if(!empty($request->with)){
            $with = explode(',', $request->with);
            foreach ($with as $value) {
                if(!in_array($value, ['ingredients', 'category', 'tags'])){
                    return response()->json(['error' => 'u request parametru with su nedopustene kljucne rijeci']);
                }
            }
            $meals->with($with);
        }

        if (!empty($request->category)) {
            if (is_numeric($request->category)) {
                $meals->where('category_id', $request->category);
            } elseif ($request->category == 'NULL') {
                $meals->whereNull('category_id');
            } elseif ($request->category == '!NULL') {
                $meals->whereNotNull('category_id');
            }
            else{
                return response()->json(['error' => 'u request parametru category su nedopustene vrijednosti']);
            }
        }

        if (!empty($request->tags)) {
            $tags = explode(',', $request->tags);
            foreach ($tags as $val) {
                if(is_numeric($val) && $val > 0 && floor($val) == $val){
                    $meals->whereHas('tags', function($query) use ($val){
                        $query->where('id', $val);
                    });
                }else{
                    return response()->json(['error' => 'u request parametru tags su nedopustene vrijednosti']);
                }
            }
        }

        if (!empty($request->diff_time)){
            if(is_numeric($request->diff_time) && $request->diff_time > 0 && floor($request->diff_time) == $request->diff_time){
                $meals = $meals->withTrashed();
                $meals->where(function($query) use ($request){
                    $query->where('created_at','>', Carbon::createFromTimestamp($request->diff_time)->toDateTimeString())
                        ->orWhere('updated_at','>', Carbon::createFromTimestamp($request->diff_time)->toDateTimeString())
                        ->orWhere('deleted_at','>', Carbon::createFromTimestamp($request->diff_time)->toDateTimeString());
                });
            }        
            else{
                return response()->json(['error' => 'u request parametru diff_time su nedopustene vrijednosti']);
            }
        }
        
        if(is_numeric($request->per_page) && ! empty($request->per_page)){
            $meals = $meals->paginate($request->per_page);
        }
        else{
            $meals = $meals->paginate(15);
            //$meals =$meals->get();
        }


        return MealResource::collection($meals);
    }
}

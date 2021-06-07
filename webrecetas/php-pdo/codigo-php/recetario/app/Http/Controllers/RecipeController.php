<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

use App\Recipe;

class RecipeController extends Controller
{
    //
    public function getHome(Request $request){
        
        if(request()->has('category_id')){
            $recipes = Recipe::where('category_id',request('category_id'))->orderBy('id','desc')->paginate(6)->appends('category_id', request('category_id'));
        }elseif(request()->has('search')){
            $recipes = Recipe::where('title', 'like', '%'.request('search').'%')->orderBy('id','desc')->paginate(6)->appends('title', request('search'));
        }else{
            $recipes = Recipe::orderBy('id','desc')->paginate(6);
        }
        foreach($recipes as $recipe){
            $categories[] = DB::table('category')->where('id',$recipe->category_id)->get();
        }
        return view('home',['recipes'=> $recipes, 'categories'=>$categories]);
    }

    public function getIndex(Request $request){
        if(request()->has('category_id')){
            $recipes = Recipe::where('category_id',request('category_id'))->orderBy('id','desc')->paginate(9)->appends('category_id', request('category_id'));
        }elseif(request()->has('search')){
            $recipes = Recipe::where('title', 'like', '%'.request('search').'%')->orderBy('id','desc')->paginate(9)->appends('title', request('search'));
        }else{
            $recipes = Recipe::orderBy('id','desc')->paginate(9);
        }
        foreach($recipes as $recipe){
            $categories[] = DB::table('category')->where('id',$recipe->category_id)->get();
        }
        
        $categoriesSelect = DB::table('category');

        if(empty($categories)){
            return view('index',['recipes'=> $recipes,'categoriesSelect'=>$categoriesSelect->get()]);
        }

        return view('index',['recipes'=> $recipes, 'categories'=>$categories, 'categoriesSelect'=>$categoriesSelect->get()]);
    }

    public function getRecipe($id){
        $recipe = Recipe::find($id);
        $comments = DB::table('comment')->where('recipe_id',$id)->orderBy('id','desc')->paginate(20);
        $userId = Auth::id();
        $favourites = DB::table('favourite')->where('recipe_id',$id)->where('user_id',$userId)->get();
        $isFavourite;
        if(count($favourites)!=0){
            $isFavourite=true;
        }else{
            $isFavourite=false;
        }
        $category = DB::table('category')->where('id',$recipe->category_id)->get();
        $usersId=[];
        foreach($comments as $comment){
            array_push($usersId,$comment->{"user_id"});
        }
        $usersNames=[];
        for ($i = 0; $i <= count($usersId)-1; $i++) {
            array_push($usersNames,(DB::table('users')->where('id',$usersId[$i])->get())[0]->{'name'});
        }
        $usersImages=[];
        for ($i = 0; $i <= count($usersId)-1; $i++) {
            array_push($usersImages,(DB::table('users')->where('id',$usersId[$i])->get())[0]->{'image'});
        }
        return view('recipes/recipe', ['recipe'=> $recipe, 'comments'=>$comments, 'isFavourite'=>$isFavourite, 'category'=>$category[0],'names'=>$usersNames, 'images'=>$usersImages]);
    }

    public function getPanel(Request $request){

        $userId = Auth::id();
        $user = DB::table('users')->where('id',$userId)->get();

        if(request()->has('category_id')){
            $myRecipes = DB::table('recipe')->where('user_id',$userId)->where('category_id',request('category_id'))->orderBy('id','desc')->paginate(5)->appends('category_id', request('category_id'));
        }elseif(request()->has('search')){
            $myRecipes = DB::table('recipe')->where('title', 'like', '%'.request('search').'%')->orderBy('id','desc')->paginate(5)->appends('title', request('search'));
        }else{
            $myRecipes = DB::table('recipe')->where('user_id',$userId)->orderBy('id','desc')->paginate(5);
        }
        $categoriesSelect = DB::table('category');
        return view('userPanel/panel', ['user' => $user, 'myRecipes'=>$myRecipes, 'categoriesSelect'=>$categoriesSelect->get()]);
    }

    public function getPanelF(Request $request){

        $userId = Auth::id();
        $user = DB::table('users')->where('id',$userId)->get();
        $favourites[] = DB::table('favourite')->where('user_id',$userId)->get();

        if(request()->has('category_id')){
            $myRecipes = DB::table('recipe')->join('favourite',function($join){
                $userId = Auth::id();
                $join->on('recipe.id','=','favourite.recipe_id')->where('favourite.user_id',$userId);
            })->where('category_id',request('category_id'))->orderBy('recipe.id','desc')->paginate(11)->appends('category_id', request('category_id'));
        }elseif(request()->has('search')){
            $myRecipes = DB::table('recipe')->join('favourite',function($join){
                $userId = Auth::id();
                $join->on('recipe.id','=','favourite.recipe_id')->where('favourite.user_id',$userId);
            })
            ->where('title', 'like', '%'.request('search').'%')->orderBy('recipe.id','desc')->paginate(12)->appends('title', request('search'));;
        }else{
            $myRecipes = DB::table('recipe')->join('favourite',function($join){
                $userId = Auth::id();
                $join->on('recipe.id','=','favourite.recipe_id')->where('favourite.user_id',$userId);
            })
            ->orderBy('recipe.id','desc')->paginate(4);
        }

        $categoriesSelect = DB::table('category');
        //var_dump($myRecipes);
        return view('userPanel/favourites', ['user' => $user, 'myRecipes'=>$myRecipes, 'categoriesSelect'=>$categoriesSelect->get()]);
    }

    public function getUserRecipe($id){
        $recipe = Recipe::find($id);
        return view('userPanel/userRecipes', ['recipe'=>$recipe]);
    }

    public function getcreateRecipe(){ 
        $categories = DB::table('category')->orderBy('id','asc')->get();
        return view('recipes/createRecipe',['categories'=>$categories,'mode'=>1]);
    }

    public function createRecipe(Request $request){ 
        
        DB::table('recipe')->insert([
                'user_id' => Auth::id(),
                'title' => $request->input('title'),
                'description' => $request->input('description'),
                'ingredients' => $request->input('ingredients'),
                'category_id' => $request->input('category'),
                'image' => 'data:image/jpeg;base64,'.base64_encode(file_get_contents($request->file('image')->path())),
                ]);

        $userId = Auth::id();
        $user = DB::table('users')->where('id',$userId)->get();
        $myRecipes = DB::table('recipe')->where('user_id',$userId)->orderBy('id','desc')->get();

        return redirect('panel');
    }

    public function getupdateRecipe($recipe_id){ 
        $recipe = Recipe::find($recipe_id);
        $category_id=$recipe->get()[0]->category_id;
        $categories = DB::table('category')->orderBy('id','asc')->get();
        return view('recipes/createRecipe',['mode'=>2, 'recipe' => $recipe, 'category_id'=>$category_id,'categories'=>$categories]);
    }

    public function updateRecipe(Request $request,$recipe_id){ 
        if($request->file('image')==null){
            DB::table('recipe')->where('id',$recipe_id)->update([
                'user_id' => Auth::id(),
                'title' => $request->input('title'),
                'description' => $request->input('description'),
                'ingredients' => $request->input('ingredients'),
                'category_id' => $request->input('category'),
                ]);
        }else{
            DB::table('recipe')->where('id',$recipe_id)->update([
                'user_id' => Auth::id(),
                'title' => $request->input('title'),
                'description' => $request->input('description'),
                'ingredients' => $request->input('ingredients'),
                'category_id' => $request->input('category'),
                'image' => 'data:image/jpeg;base64,'.base64_encode(file_get_contents($request->file('image')->path())),
                ]);
        }
        $userId = Auth::id();
        $user = DB::table('users')->where('id',$userId)->get();
        $myRecipes = DB::table('recipe')->where('user_id',$userId)->orderBy('id','desc')->get();

        return redirect('panel');
    }    

    public function deleteRecipe(Request $request,$recipe_id){ 
        DB::table('favourite')->where('recipe_id', $recipe_id)->delete();
        DB::table('comment')->where('recipe_id', $recipe_id)->delete();
        $recipe = DB::table('recipe')->where('id', $recipe_id)->delete();
        
        $userId = Auth::id();
        $user = DB::table('users')->where('id',$userId)->get();
        $myRecipes = DB::table('recipe')->where('user_id',$userId)->orderBy('id','desc')->get();

        return redirect('panel');
    }  

    public function insertComment(Request $request,$recipe_id){ 
        $userId = Auth::id();
        DB::table('comment')->insert([
            'user_id' => $userId,
            'recipe_id' => $recipe_id,
            'text' => $request->input('comment'),
        ]);

        $recipe = Recipe::find($recipe_id);
        $comments = DB::table('comment')->where('recipe_id',$recipe_id)->orderBy('id','desc')->paginate(20);

        $favourites = DB::table('favourite')->where('recipe_id',$recipe_id)->where('user_id',$userId)->get();
        $isFavourite;
        if(count($favourites)!=0){
            $isFavourite=true;
        }else{
            $isFavourite=false;
        }
        
        return redirect('recipe/'.$recipe_id);
    }

    public function deleteComment(Request $request,$comment_id, $recipe_id){
        DB::table('comment')->where('id', $comment_id)->delete();
        $userId = Auth::id();
        $recipe = Recipe::find($recipe_id);
        $comments = DB::table('comment')->where('recipe_id',$recipe_id)->orderBy('id','desc')->paginate(20);

        $favourites = DB::table('favourite')->where('recipe_id',$recipe_id)->where('user_id',$userId)->get();
        $isFavourite;
        if(count($favourites)!=0){
            $isFavourite=true;
        }else{
            $isFavourite=false;
        }
        return redirect('recipe/'.$recipe_id);
    }  

    public function getCategories(){ 
        $categories = DB::table('category');

        return view('recipes/recipe', ['recipe'=> $recipe, 'comments'=>$comments]);
    }

    public function setRecipeFavourite($recipe_id){ 
       
       $userId = Auth::id();
        DB::table('favourite')->insert([
            'user_id' => $userId,
            'recipe_id' => $recipe_id
        ]);

        $recipe = Recipe::find($recipe_id);
        $comments = DB::table('comment')->where('recipe_id',$recipe_id)->orderBy('id','desc')->paginate(20);
        $favourites = DB::table('favourite')->where('recipe_id',$recipe_id)->where('user_id',$userId)->get();
        $isFavourite;
        if(count($favourites)!=0){
            $isFavourite=true;
        }else{
            $isFavourite=false;
        }
        $category = DB::table('category')->where('id',$recipe->category_id)->get();
        $usersId=[];
        foreach($comments as $comment){
            array_push($usersId,$comment->{"user_id"});
        }
        $usersNames=[];
        for ($i = 0; $i <= count($usersId)-1; $i++) {
            array_push($usersNames,(DB::table('users')->where('id',$usersId[$i])->get())[0]->{'name'});
        }
        $usersImages=[];
        for ($i = 0; $i <= count($usersId)-1; $i++) {
            array_push($usersImages,(DB::table('users')->where('id',$usersId[$i])->get())[0]->{'image'});
        }
        return view('recipes/recipe', ['recipe'=> $recipe, 'comments'=>$comments, 'isFavourite'=>$isFavourite, 'category'=>$category[0],'names'=>$usersNames, 'images'=>$usersImages]);
    }

    public function unsetRecipeFavourite($recipe_id){ 
    
        $userId = Auth::id();
        DB::table('favourite')->where('recipe_id',$recipe_id)->where('user_id',$userId)->delete();

        $recipe = Recipe::find($recipe_id);
        $comments = DB::table('comment')->where('recipe_id',$recipe_id)->orderBy('id','desc')->paginate(20);
        $favourites = DB::table('favourite')->where('recipe_id',$recipe_id)->where('user_id',$userId)->get();
        $isFavourite;
        if(count($favourites)!=0){
            $isFavourite=true;
        }else{
            $isFavourite=false;
        }
        $category = DB::table('category')->where('id',$recipe->category_id)->get();
        $usersId=[];
        foreach($comments as $comment){
            array_push($usersId,$comment->{"user_id"});
        }
        $usersNames=[];
        for ($i = 0; $i <= count($usersId)-1; $i++) {
            array_push($usersNames,(DB::table('users')->where('id',$usersId[$i])->get())[0]->{'name'});
        }
        $usersImages=[];
        for ($i = 0; $i <= count($usersId)-1; $i++) {
            array_push($usersImages,(DB::table('users')->where('id',$usersId[$i])->get())[0]->{'image'});
        }
        return view('recipes/recipe', ['recipe'=> $recipe, 'comments'=>$comments, 'isFavourite'=>$isFavourite, 'category'=>$category[0],'names'=>$usersNames, 'images'=>$usersImages]);
    }

    public function updateUserImage(Request $request,$user_id){ 
        if($request->file('image')!=null){
            DB::table('users')->where('id',$user_id)->update([
                'image' => 'data:image/jpeg;base64,'.base64_encode(file_get_contents($request->file('image')->path())),
                ]);
        }        
        $userId = Auth::id();
        $user = DB::table('users')->where('id',$userId)->get();
        $myRecipes = DB::table('recipe')->where('user_id',$userId)->orderBy('id','desc')->get();
        return redirect('panel');
    }
}

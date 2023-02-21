<?php

namespace App\Models;

use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Support\Facades\File;
use Spatie\YamlFrontMatter\YamlFrontMatter;

class CourseClass
{
    public function __construct(public $title, public $slug, public $excerpt, public $date, public $body)
    {
    }

    public static function all()
    {
        return cache()->rememberForever('posts.all', function () {
            return collect(File::files(resource_path("posts")))
                ->map(fn($file) => YamlFrontMatter::parseFile($file))
                ->map(fn($document) => new Post(
                    $document->title,
                    $document->slug,
                    $document->excerpt,
                    $document->date,
                    $document->body()
                ))
                ->sortByDesc('date');
        });
    }

    public static function find($slug)
    {
        return static::all()->firstWhere('slug', $slug);
    }

    public static function findOrFail($slug)
    {
        $post = static::find($slug);
        if (!$post) {
            throw new ModelNotFoundException();
        }

        return $post;
    }
}

/**
 * Use array map to avoid inside foreach array building.
 */

//$posts = array_map(function ($file) {
//    foreach ($files as $file) {
//        $document = YamlFrontMatter::parseFile($file);
//        $post[] = new Post(
//            $document->title,
//            $document->slug,
//            $document->excerpt,
//            $document->date,
//            $document->body()
//        );
//    }
//    $document = YamlFrontMatter::parseFile($file);
//    return new Post(
//        $document->title,
//        $document->slug,
//        $document->excerpt,
//        $document->date,
//        $document->body()
//    );
//}, $files);

/**
 * DB debugger
 */
//\DB::listen(function ($query){
//    logger($query->sql, $query->bindings);
//});

/**
 * Serach Component
 */
//
//$posts = Post::latest();
//if (request('search')) {
//    $posts
//        ->where('title', 'like', '%' . request('search') .'%')
//        ->orWhere('body', 'like', '%' . request('search') .'%');
//
//}


//Search Category by their Slug
//$query->when($filters['category'] ?? false, fn($query, $category) => $query
//    ->whereExists(fn($query) => $query->from('categories')
//        ->whereColumn('categories.id', 'posts.category_id')
//        ->where('categories.slug', $category))
//);


//Using combined search, web roots are not needable

//
//Route::get('categories/{category}', function (Category $category) {
//    return view('posts', [
//        'posts' => $category->posts,
//        'currentCategory' => $category,
//        'categories' => Category::all()
//    ]);
//});
//
//Route::get('authors/{author:username}', function (User $author) {
//    return view('posts.index', [
//        'posts' => $author->posts,
//    ]);
//});

/**
 * Copy from vendor to resources
 *   php artisan vendor:publish
 *   In the list select package.
 */

/**
 * Local data
 */
// Post::factory(10)->create(['category_id' => 2])

/**
 * Check the password
 */
//php artisan tinker
//
//$user = User::find(ID);
//Illuminate\Support\Facades\Hash::check('password', $user->password);
//-> TRUE/FALSE


/**
 * Create USER
 */
//$attributes = request()->validate([
//    'name' => 'required|max:255',
//    'username' => 'required|max:255|min:3',
//    'email' => 'required|email|max:255',
//    'password' => ['required', 'min:7', 'max:255']
//]);
//$attributes['password'] = bcrypt($attributes['password']);
//User::create($attributes);

/**
 * Modify attributes in the Model
 */
//setKeyAttribute -> default method
//    public function setPasswordAttribute($password)
//{
//    $this->attributes['password'] = bcrypt($password);
//
//}
// EXAMPLE
//
//public function setUsernameAttribute($username)
//{
//    $this->attributes['username'] = ucwords($username);
//}

/**
 * Validation exmaple
 */
//'username' => 'required|max:255|min:3|unique:users,username',
//'username' => ['required', max:255', min:3', Rule::unique('users', 'nickname')],

/**
 * Flash messages
 */
//session()->flash('success', 'Your account has been created.');
//or use ->with()

/**
 * Check if user logged in
 */
//  @guest
// if(auth()->check())
// @unlesss(auth->check())

/**
 * Errors
 */
//throw ValidationException::withMessages([
//    'email' => 'Your provided credentials could not be verified.'
//]);
// Other way aroun.
//        return back()
//            ->withInput()
//            ->withErrors(['email' => 'Your provided credentials could not be verified.']);


//ForeignId example with connection (comments,posts)
//$table->foreign('post_id')->references('id')->on('posts')->onDelete('cascade');
//            $table->unsignedBigInteger('post_id');
//            $table->foreign('post_id')->references('id')->on('posts')->cascadeOnDelete();

/**
 * 7 usefull controlle functions, ""GENERAL RULE""
 */
// index (show), show (show1), store, edit, update, destroy

/**
 * Slug example - 1.create 2.update
 */
// 'slug' => ['required', Rule::unique('posts', 'slug')
// 'slug' => ['required', Rule::unique('posts', 'slug')->ignore($post->id)

/**
 * Authorize -> gate
 */
//auth()->user()->can('admin')
// $this->authorize('admin') -> created under AppService provider


// TODO
//1. Export Controller validations to custom requests.
//2. Clear controllers with observers example -> After creating user, log user in in observer and logout after destroy

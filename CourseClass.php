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

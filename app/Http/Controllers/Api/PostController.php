<?php

namespace App\Http\Controllers\Api;

use App\Enums\UsersRolesEnums;
use App\Http\Controllers\Controller;
use App\Http\Resources\PostCollection;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class PostController extends Controller
{

    public function all_posts()
    {
        if (auth()->user()->role !== UsersRolesEnums::admin) {
            return response()->error('Sorry only admin can view this.', 400);
        }

        $posts = PostCollection::collection(Post::orderBy('created_at', 'desc')->get())->paginate(env('PAGINATION'));
        return response()->json([
            'data' => $posts->values(),
            'pagination' => collect($posts)->except('data', 'links')
        ]);
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $posts = PostCollection::collection(Post::where('user_id', auth()->user()->id)->orderBy('created_at', 'desc')->get())->paginate(env('PAGINATION'));
        return response()->json([
            'data' => $posts->values(),
            'pagination' => collect($posts)->except('data', 'links')
        ]);
    }


    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        try {
            $moderationWords = ['badword1', 'badword2', 'badword3'];
            $validator = Validator::make($request->all(), [
                'title' => 'required',
                'post_content' => 'required',
            ], [
                'title.required' => 'Title is required.',
                'post_content.required' => 'Content is required.',
            ]);

            if ($validator->fails()) {
                return response()->error($validator->errors()->first(), 400);
            }

            $containsModeratedTitle = false;
            foreach ($moderationWords as $word) {
                if (stripos($request->title, $word) !== false) {
                    $containsModeratedTitle = true;
                    break;
                }
            }

            $containsModeratedContent = false;
            foreach ($moderationWords as $word) {
                if (stripos($request->post_content, $word) !== false) {
                    $containsModeratedContent = true;
                    break;
                }
            }

            if ($containsModeratedTitle || $containsModeratedContent) {
                return response()->error('The content or title contains prohibited language.', 400);
            }

            $post = new Post();
            $post->user_id = auth()->user()->id;
            $post->title = $request->title;
            $post->post_content = $request->post_content;
            $post->save();

            return response()->success('Post has been added successfully');
        } catch (\Throwable $exception) {
            return response()->error($exception->getMessage(), 500);
        }
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        try {
            $moderationWords = ['badword1', 'badword2', 'badword3'];

            $validator = Validator::make($request->all(), [
                'title' => 'required',
                'post_content' => 'required',
            ], [
                'title.required' => 'Title is required.',
                'post_content.required' => 'Title is required.',
            ]);

            if ($validator->fails()) {
                return response()->error($validator->errors()->first(), 400);
            }

            $containsModeratedTitle = false;
            foreach ($moderationWords as $word) {
                if (stripos($request->title, $word) !== false) {
                    $containsModeratedTitle = true;
                    break;
                }
            }

            $containsModeratedContent = false;
            foreach ($moderationWords as $word) {
                if (stripos($request->post_content, $word) !== false) {
                    $containsModeratedContent = true;
                    break;
                }
            }

            if ($containsModeratedTitle || $containsModeratedContent) {
                return response()->error('The content or title contains prohibited language.', 400);
            }

            $post = Post::find($id);

            if ($post->user_id !== auth()->user()->id) {
                return response()->error('Sorry you can not update this post. because you are not the owner', 400);
            }

            $post->title = $request->title;
            $post->post_content = $request->post_content;
            $post->save();

            return response()->success('Post has been updated successfully');
        } catch (\Throwable $exception) {
            return response()->error($exception->getMessage(), 500);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        if ($id === null) {
            return response()->error('Please select post first to delete.', 400);
        }

        $post = Post::find($id);
        if ($post->user_id !== auth()->user()->id) {
            return response()->error('Sorry you can not delete this post. because you are not the owner', 400);
        }

        $post->delete();

        return response()->success('Post has been deleted successfully');
    }
}

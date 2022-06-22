<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\SearchRequest;
use App\Http\Resources\PostResource;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use Illuminate\Http\Response;

/**
 * @OA\Tag(
 *     name="posts",
 *     description="Post related operations"
 * )
 * @OA\Info(
 *     version="1.0",
 *     title="RSS API",
 *     description="Test PSS API",
 *     @OA\Contact(name="kyiv1414@gmail.com")
 * )
 * @OA\Server(
 *     url="https://localhost",
 *     description="API server"
 * )
 */
class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return AnonymousResourceCollection
     */
    /**
     * @OA\Get(
     *     path="/api/posts",
     *     tags={"Posts"},
     *     summary="",
     *     @OA\Response(
     *         response=200,
     *         description="successful operation",
     *          @OA\JsonContent(
     *              @OA\Property(property="items", type="array", @OA\Items(ref="#/components/schemas/Post")),
     *              @OA\Property(property="_meta", type="object", ref="#/components/schemas/Meta"),
     *          )
     *     )
     * )
     */
    public function index(): AnonymousResourceCollection
    {
        return
            PostResource::collection(Post::paginate());
    }

    /**
     * Display a listing of search.
     *
     * @param SearchRequest $request
     * @return AnonymousResourceCollection
     */
    /**
     * @OA\Get(
     *     path="/api/posts/search",
     *     tags={"Posts"},
     *     summary="Search by title by LIKE",
     *     @OA\Response(
     *         response=200,
     *         description="successful operation",
     *          @OA\JsonContent(
     *              @OA\Property(property="items", type="array", @OA\Items(ref="#/components/schemas/Post")),
     *              @OA\Property(property="_meta", type="object", ref="#/components/schemas/Meta"),
     *          )
     *     )
     * )
     */
    public function search(SearchRequest $request): AnonymousResourceCollection
    {
        $posts = Post::where(  function ($q) use ($request) {
            if($request->exists('title')) {
                $q->where('title', 'like', "%".$request->title."%");
            }
        })
            ->paginate();

        return PostResource::collection($posts);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  Request  $request
     * @return PostResource
     */
    public function store(Request $request): PostResource
    {
        $post = Post::create($request->all());
        $categories = explode(",", $request->get('categories'));
        $post->add_categories($categories);
        return new PostResource($post);
    }

    /**
     * Display the specified resource.
     *
     * @param  Post $post
     * @return PostResource
     */
    public function show(Post $post)
    {
        return new PostResource($post);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  Request  $request
     * @param  Post $post
     * @return PostResource
     */
    public function update(Request $request, Post $post): PostResource
    {
        $post->update($request->all());
        return new PostResource($post);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  Post $post
     * @return Response
     */
    public function destroy(Post $post): Response
    {
        $post->delete();

        return response(null, 204);
    }
}

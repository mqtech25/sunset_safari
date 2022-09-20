<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\BaseController;
use App\Models\Post;
use App\Repositories\PostRespository;
use App\Contracts\PostContract;
use Illuminate\Http\Request;
use App\Traits\UploadAble;

class PostsController extends BaseController
{
    use UploadAble;
    protected $postRepository;

    public function __construct(PostContract $postRepository)
    {
        \Log::info("Req=PostController@__construct called");
        if(config('settings.blog_enabled') == '0')
        {
            \App::abort(404);
        }
        $this->postRepository = $postRepository;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        \Log::info("Req=PostController@create called");
        $posts = $this->postRepository->listPosts();
        $this->setPageTitle('Posts', 'List All Posts');
        return view('admin.posts.index', compact('posts'));
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        \Log::info("Req=PostController@create called");
        $this->setPageTitle('Create Post', 'Create Post');

        $post = $this->postRepository->createPost();
        if (!$post) {
            return $this->responseRedirectBack('Error occured while creating post Or duplicate post slug', 'error', true, true);
        }

        return view('admin.posts.create', compact('post'));

    }


    /**
	* product image upload
	* @param Request $request
	*/
	public function uploadImage(Request $request){
		\Log::info("Req=PostsController@uploadImage called");
        $post = $this->postRepository->findOneOrFail($request->post_id);
        if($post->images != '')
        {
            $this->deleteBulkImages($post->id);
        }

		if($request->has('image')){
			$fileName = $post->slug."-".$post->id;
			$imgName = $fileName.uniqid (rand ());
			$mainImg = $imgName.'.'.$request->image->getClientOriginalExtension();
			$path ='\storage\posts\\'.$request->post_id;
			\Storage::makeDirectory($path);
			// \File::makeDirectory($path, $mode = 0777, true, true);
			
			
			$image = $this->uploadOne($request->image, 'posts/'.$request->post_id, 'public', $imgName);
			$postThumb = $this->uploadThumbs($request->image,$path.'\\', $fileName, config('settings.post_thumb_image_width'));
			$imgNames = ['full'=>$mainImg,'postthumb'=>$postThumb];
			$imgNames = json_encode($imgNames);

			$post->path = $path;
            $post->images = $imgNames;
            $post->save();

		}

		return response()->json(['status' => 'success']);
    }
    

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Post  $Post
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $request->validate([
            'title'=> ['required', 'string'],
            'slug'=> ['required', 'string', 'unique:blog_posts'],
            'description'=> ['required'],
            'meta_title'=> ['required'],
            'meta_description'=> ['required'],
            'meta_tags'=> ['required'],
        ]);

        $params = $request->except('_token');
		$updatePost = $this->postRepository->updatePost($params);

		if(!$updatePost){
			return $this->responseRedirectBack('Error occurred while updating Post', 'error', true, true);
		}

		return $this->responseRedirect('admin.posts.index', 'Post has been updated successfully', 'success');
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Post  $Post
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        \Log::info("Req=PostController@edit called");
        $this->setPageTitle('Post', 'Edit Post');

		$post = $this->postRepository->findPostById($id);
		return view('admin.posts.create', compact('post'));
    }


    public function deleteBulkImages($id){
		$post = $this->postRepository->findOneOrFail($id);
		foreach(json_decode($post->images) as $imageName)
		{
			if($imageName != ''){
				$this->deleteThumbs($post->path,$imageName);
			}
		}
        $post->images='';
        $post->save();
		return redirect()->back();
    }
    

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        \Log::info("Req=PostsController@destroy called");
        $deletePost = $this->postRepository->deletePost($id);
		if(!$deletePost){
			return $this->responseRedirectBack('Error occured while deleting post', 'error', true, true);
		}
		return $this->responseRedirect('admin.posts.index', 'Post has been deleted successfully', 'success');
    }

}

<?php
namespace App\Repositories;

use App\Contracts\PostContract;
use App\Models\Post;
use Illuminate\Database\QueryException;
use Doctrine\Instantiator\Exception\InvalidArgumentException;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use App\Traits\UploadAble;
use Illuminate\Support\Str;


class PostRepository extends BaseRepository implements PostContract{
	use UploadAble;
	/**
	* PostRepository Constructor
	* @param Post $model
	*/
	public function __construct(Post $model){
		\Log::info("Req=PostRepository@__construct called");
		parent::__construct($model);
		$this->model = $model;
	}
	

	/**
	* @param string $order
	* @param string $sort
	* @param array $columns
	* @return mixed
	*/
	public function listPosts(string $order = 'id', string $sort = 'desc', array $columns = ['*']){
		\Log::info("Req=PostsRepository@listPosts called");
		return $this->all($columns, $order, $sort);	
	}

	
	/**
	* @param array $params
	* @return Posts|mixed
	*/
	public function createPost(){
		\Log::info("Req=PostRepository@createPost called");
		try {
				$randomId = rand(10,100);
				$post = new Post();
				$post->admin_id = \Auth::user()->id;
				$post->title = "Untitled Post";
				$post->slug="untitled-Post".$randomId;
				$post->path = '';
				$post->images = '';
				$post->description = '';
				$exists = $this->findPostBySlug($post->slug);
				if(!$exists){
					$post->save();
					return $post;
				}
				return false;
			
		} catch (QueryException $e) {
			throw new InvalidArgumentException($e->getMessage());
		}
	}

	/**
	 * @param int $id
	 * @return mixed
	 * @throws ModelNotFoundException
	 */
	public function findPostById($id){
		\Log::info("Req=PostRepository@findPostById called");
		try{
			return $this->findOneOrFail($id);
		}catch(ModelNotFoundException $e){
			throw new ModelNotFoundException($e);
		}
	}


	/**
	 * @param int $slug
	 * @return mixed
	 * @throws ModelNotFoundException
	 */
	public function findPostBySlug($slug){
		\Log::info("Req=PostRepository@findPostBySlug called");
		try{
			return $this->findOneBy(['slug'=>$slug]);
		}catch(ModelNotFoundException $e){
			throw new ModelNotFoundException($e);
		}
	}


	/**
	 * @param array $params
	 * @return mixed
	 */
	public function updatePost($params){
		\Log::info("Req=PostRepository@updatePost called");
		$Post = $this->findPostById($params['id']);
		$colleciton = collect($params)->except('_token');
		$separator ='-';
		
		$status = $colleciton['status'];
		$slug = str_slug($colleciton['slug'], $separator);
		
		
		$merge = $colleciton->merge(compact('status','slug'));
		// dd($merge->all());
		$Post->update($merge->all());

		return $Post;

	}
	
	/**
	 * @param int id
	 */
	public function deletePost($id){
		\Log::info("Req=PostRepository@deletePost called");

		$Post = $this->findPostById($id);
		try{
			$deleteImages = \File::deleteDirectory(public_path('/storage/posts/'.$id));
		}catch(Exception $e){
			
		}
		$Post->delete();
		return $Post;
	}

	
}

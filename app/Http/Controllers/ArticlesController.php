<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Phphub\Core\CreatorListener;

use App\Models\Post;
use App\Models\User;
use App\Models\Topic;
use App\Models\Banner;
use App\Models\Blog;
use Illuminate\Http\Request;
use Auth;
use Flash;
use Phphub\Markdown\Markdown;

use App\Http\Requests\StoreTopicRequest;
use Cache;

class ArticlesController extends Controller implements CreatorListener
{
	// 主体列表使用缓存[20190612]
    public $topic_list_cache_key = "TOPICS_LIST_V1_PAGE_";
	
    public function __construct()
    {
        $this->middleware('auth', ['except' => ['index', 'show']]);
    }
	
	public function create(Request $request)
	{
        $user = Auth::user();
        if ($user->blogs()->count() <= 0) {
            Flash::info('请先创建专栏，专栏创建成功后才能发布文章。');
            return redirect()->route('blogs.create');
        }
        $topic = new Topic;

        $blog = $request->blog_id ? Blog::findOrFail($request->blog_id) : Auth::user()->blogs()->first();
        $this->authorize('create-article', $blog);
		
		$this->delListCache();  // 清除缓存

		return view('articles.create_edit', compact('topic', 'user', 'blog'));
	}

	public function store(StoreTopicRequest $request)
	{
        $data = $request->except('_token');

        $blog = Blog::findOrFail($request->blog_id);
        $this->authorize('create-article', $blog);
        $data['blog_id'] = $blog->id;

        if ($request->subject == 'draft') {
            $data['is_draft'] = 'yes';
        }
		
		$this->delListCache();  // 清除缓存
		
        return app('Phphub\Creators\TopicCreator')->create($this, $data, $blog);
	}

	public function transform($id)
	{
        Auth::user()->decrement('topic_count', 1);
        Auth::user()->increment('article_count', 1);

        if (Auth::user()->blogs()->count() <= 0) {
            Flash::info('请先创建专栏，专栏创建成功后才能发布文章。');
            return redirect()->route('blogs.create');
        }
        $topic = Topic::find($id);
        $topic->update([
            'category_id' => config('phphub.blog_category_id')
        ]);

        // attach blog
        $blog = Auth::user()->blogs()->first();
        $blog->topics()->attach($topic->id);
        $blog->increment('article_count', 1);
        // Co-authors
        if ( ! $blog->authors()->where('user_id', $topic->user_id)->exists()) {
            $blog->authors()->attach($topic->user_id);
        }
		
		$this->delListCache();  // 清除缓存

        Flash::success(lang('Operation succeeded.'));
        return redirect()->to($topic->link());
	}

	public function show($id)
	{
        // See: TopicsController->show
	}

	public function edit($id)
	{
		$topic = Topic::findOrFail($id);
		return view('articles.create_edit', compact('topic'));
	}

	public function update($id, StoreTopicRequest $request)
	{
        // See: TopicsController->update
	}
	
	// 清除Topic列表缓存
	public function delListCache()
	{
		$ceche_key = $this->topic_list_cache_key;
		
		for($i = 1; $i <= 100; $i++)
		{
			$new_cache_key = $ceche_key . $i;
			
			if(Cache::has($new_cache_key)){
				Cache::forget($new_cache_key);  // 清除缓存
			}
		}
	}
	

    /**
     * ----------------------------------------
     * CreatorListener Delegate
     * ----------------------------------------
     */

    public function creatorFailed($error)
    {
        Flash::error('发布失败：' . $error);
        return redirect()->back();
    }

    public function creatorSucceed($topic)
    {
        Flash::success(lang('Operation succeeded.'));
        return redirect()->to($topic->link());
    }
}

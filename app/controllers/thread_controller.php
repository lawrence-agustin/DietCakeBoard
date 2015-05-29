<?php 
class ThreadController extends AppController            
{
    const EDIT = 'edit';
    const EDIT_END = 'edit_end';
    const CREATE = 'create';
    const CREATE_END = 'create_end';
    const WRITE = 'write';
    const WRITE_END = 'write_end';
    const PAGE_ONE = 1;
    const THREADS_PER_PAGE = 10;
    const COMMENTS_PER_PAGE = 10;

    public function index()                        
    {
        if(isset($_SESSION["username"]))
        {
            $page = Param::get('page', self::PAGE_ONE);
            $pagination = new SimplePagination($page, self::THREADS_PER_PAGE);
            $threads = Thread::getAll($pagination->start_index - 1, $pagination->count + 1);
            $paginatedThreads = array();
            $threadOwner = array();

            for($i=0; $i < sizeof($threads); $i++) {
                $paginatedThreads[] = $threads[$i];
            }

            foreach($paginatedThreads as $v) {
                $threadOwner[] = User::getUsername($v->creator_id);
            }
            $pagination->checkLastPage($threads);
            $total = Thread::countAll();
            $pages = ceil($total / self::THREADS_PER_PAGE);
            $this->set(get_defined_vars());
        }
        else redirect(url('user/login_notice'));
    }   

    public function general_category()
    {
        if(isset($_SESSION["username"]))
        {
            $threads = Thread::getThreadsByCategory("General");
            $this->set(get_defined_vars());
        }
        else redirect(url('user/login_notice'));
    }

    public function technology_category()
    {
        if(isset($_SESSION["username"]))
        {
            $threads = Thread::getThreadsByCategory("technology");
            $this->set(get_defined_vars());
        }
        else redirect(url('user/login_notice'));
    }

    public function music_category()
    {
        if(isset($_SESSION["username"]))
        {
            $threads = Thread::getThreadsByCategory("music");
            $this->set(get_defined_vars());
        }
        else redirect(url('user/login_notice'));
    }

    public function arts_category()
    {
        if(isset($_SESSION["username"]))
        {
            $threads = Thread::getThreadsByCategory("arts");
            $this->set(get_defined_vars());
        }
        else redirect(url('user/login_notice'));
    }

    public function view()                
    {
        if(isset($_SESSION["username"])) 
        {
            $thread = Thread::get(Param::get('thread_id'));
            $thread_id = Param::get('thread_id');
            $owner = Thread::getOwnerId($thread_id);
            $ownerId = $owner["creator_id"];
            $ownerUsername = User::getUsername($ownerId);
            $comments = Comment::getComments($ownerId);      
            $page = Param::get("page", self::PAGE_ONE); 
            $pagination = new SimplePagination($page, self::COMMENTS_PER_PAGE);
            $comments = Comment::getAll($thread_id, $pagination->start_index - 1, $pagination->count + 1);
            $pagination->checkLastPage($comments);
            $total = Comment::countAll($thread_id);
            $pages = ceil($total / self::COMMENTS_PER_PAGE);
            $threadContent = Thread::getBodyContents((int)$thread_id);
            $this->set(get_defined_vars());
        }
        else redirect(url('user/login_notice'));
    }

    public function edit()
    {
        if(isset($_SESSION["username"]))
        {
            $thread = Thread::get(Param::get('thread_id'));
            $page = Param::get('page_next', 'edit');
            $_SESSION["title"] = Param::get('title');
            $_SESSION["threadBody"] = Param::get('thread_body');
            switch ($page) {
            case self::EDIT:                    
                break;
            case self::EDIT_END:  
                $title                      = Param::get('title');
                $threadBody                 = Param::get('thread_body');
                $thread->new_title          = $title;
                $thread->new_thread_body    = $threadBody;
                try {            
                        $thread->update(Param::get('thread_id'));
                } catch (ValidationException $e) {                    
                       $page = 'edit';
                    }                           
                break;
            default:                    
                throw new NotFoundException("{$page} is not found");        
                break;
            }
            $this->set(get_defined_vars());
            $this->render($page);
        }
        else redirect(url('user/login_notice'));
    }

    public function create()
    { 
        if(isset($_SESSION["username"])) 
        {
            $thread = new Thread();
            $comment = new Comment();
            $page = Param::get('page_next','create');
            switch($page){
                case self::CREATE:
                    break;
                case self::CREATE_END:
                    $thread->title = Param::get('title');
                    $thread->body = Param::get('thread_body');
                    $category = Param::get('category');
                    $creatorId = User::getUserId(Param::get('user'));
                    $comment->username = Param::get('username');
                    $comment->body = Param::get('body');
                    try {
                        $thread->create($comment, $creatorId, $category);
                    } 
                    catch(ValidationException $e) {
                          $page = 'create';
                    }
                    break;
                default:
                    throw new NotFoundException("{$page} not found");
                    break;
            }   
            $this->set(get_defined_vars());                    
            $this->render($page);   
        }
        else redirect(url('user/login_notice'));  
    }

    public function edit_end()
    {   
    }

    public function confirm_delete()
    {
        if(isset($_SESSION["username"])) 
        {
            $thread = Thread::get(Param::get('thread_id'));
            $thread_id = Param::get('thread_id');
            $this->set(get_defined_vars());
        }
        else redirect(url('user/login_notice')); 
    }

    public function deleted()
    {
        if(isset($_SESSION["username"])) 
        {
            $thread_id = Param::get('thread_id');
            $title = Thread::getTitle($thread_id);
            Thread::deleteById($thread_id);
            Comment::deleteCommentsByThreadId($thread_id);
            $this->set(get_defined_vars());
        }
        else redirect(url('user/login_notice')); 
    }

    public function write()                        
    {
        $thread = Thread::get(Param::get('thread_id'));
        $comment = new Comment();
        $page = Param::get('page_next', 'write');
        switch ($page) {
            case self::WRITE:                    
                break;
            case self::WRITE_END:                
                $comment->username = Param::get('username');
                $comment->body = Param::get('body');
                try {            
                    $thread->write($comment);
                } catch (ValidationException $e) {                    
                    $page = 'write';
                }                        
                break;
            default:                    
                throw new NotFoundException("{$page} is not found");        
                break;
        }
        $this->set(get_defined_vars());
        $this->render($page);
    }

    public function top_ten()
    {
        if(isset($_SESSION["username"]))
        {
            $topFive = Comment::getTopFive();
            $indexes = array();
            $commentCount = array();

            foreach ($topFive as $key => $v) {
                $indexes[] = $v['thread_id'];
                $commentCount[] = $v["commentCount"];
            }

            $titles = array();
            foreach($indexes as $v)
            {
                $titles[] = Thread::getTitle($v);
            }

            $this->set(get_defined_vars());
        }
        else redirect(url('user/login_notice'));
    }
}
?> 
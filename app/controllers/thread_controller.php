<?php 
class ThreadController extends AppController            
{
    public function index()                        
    {
        $threads_per_page = 10; 
        $pageOne = 1;
        $page = Param::get('page',$pageOne);
        $pagination = new SimplePagination($page, $threads_per_page);
        $threads = Thread::getAll($pagination->start_index - 1, $pagination->count + 1);
        $pagination->checkLastPage($threads);
        $total = Thread::countAll();
        $pages = ceil($total / $threads_per_page);
        $this->set(get_defined_vars());
    }   

    public function view()                
    {
        $comments_per_page = 10;
        $pageOne = 1;
        $thread = Thread::get(Param::get('thread_id'));
        $thread_id = Param::get('thread_id');
        $comments = $thread->getComments();        
        $page = Param::get("page",$pageOne); 

        $pagination = new SimplePagination($page, $comments_per_page);
        // $comments = Comment::getAll($thread_id, $pagination->start_index - 1, $pagination->count + 1);
        $pagination->checkLastPage($comments);
        $total = Comment::countAll($thread_id);
        $pages = ceil($total / $comments_per_page);
        $this->set(get_defined_vars());


    }

    public function write()                        
    {
        $thread = Thread::get(Param::get('thread_id'));
        $comment = new Comment;
        $page = Param::get('page_next', 'write');
        switch ($page) {
        case 'write':                    
            break;
        case 'write_end':                
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

    public function create()
    { 
        $thread = new Thread;
        $comment = new Comment;
        $page = Param::get('page_next','create');
        switch($page){
            case 'create':
                break;
            case 'create_end':
                $thread->title = Param::get('title');
                $comment->username = Param::get('username');
                $comment->body = Param::get('body');
                try{
                    $thread->create($comment);
                } 
                catch(ValidationException $e){
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
}
?> 
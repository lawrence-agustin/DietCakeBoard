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

        $owner = Thread::getOwnerId($thread_id);
        $ownerId = $owner["creator_id"];

        $ownerUsername = User::getUsername($ownerId);

        $comments = $thread->getComments();        
        $page = Param::get("page",$pageOne); 

        $pagination = new SimplePagination($page, $comments_per_page);
        // $comments = Comment::getAll($thread_id, $pagination->start_index - 1, $pagination->count + 1);
        $pagination->checkLastPage($comments);
        $total = Comment::countAll($thread_id);
        $pages = ceil($total / $comments_per_page);

        $threadContents = Thread::getBodyContents((int)$thread_id);
        $this->set(get_defined_vars());


    }

    public function edit()
    {
        $thread = Thread::get(Param::get('thread_id'));
        $page = Param::get('page_next', 'edit');

        switch ($page) {
        case 'edit':                    
            break;
        case 'edit_end':                        
            break;
        default:                    
            throw new NotFoundException("{$page} is not found");        
            break;
        }
        $this->set(get_defined_vars());
        $this->render($page);


    }

    public function edit_end()
    {   

        $thread = Thread::get(Param::get('thread_id'));
        $title = Param::get('title');
            $threadBody = Param::get('thread_body');
            $thread->new_title          = $title;
            $thread->new_thread_body    = $threadBody;
            try {            
                //$thread->update($title,$threadBody);
                $thread->update(Param::get('thread_id'));

            } catch (ValidationException $e) {                    
                $page = 'edit';
            }                   

        $thread = Thread::get(Param::get('thread_id'));
        $this->set(get_defined_vars());
    }

    public function confirm_delete()
    {
        $thread = Thread::get(Param::get('thread_id'));
        $thread_id = Param::get('thread_id');
        $this->set(get_defined_vars());
    }

    public function deleted()
    {
        $thread_id = Param::get('thread_id');
        $title = Thread::getTitle($thread_id);
        Thread::deleteThreadById($thread_id);
        
        $this->set(get_defined_vars());
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
                $threadBody = Param::get('thread_body');
                $creatorId = User::getUserId(Param::get('user'));
                $comment->username = Param::get('username');
                $comment->body = Param::get('body');
                try{
                    $thread->create($comment, $threadBody, $creatorId);
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




}
?> 
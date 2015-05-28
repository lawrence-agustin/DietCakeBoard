<?php
	class CommentController extends AppController
	{
		const WRITE = 'write';
		const WRITE_END = 'write_end';

		public function write()                        
	    {
	        $thread = Thread::get(Param::get('thread_id'));
	        $threadId = Param::get('thread_id');
	        $comment = new Comment();
	        $page = Param::get('page_next', 'write');
	        switch ($page) {
		        case self::WRITE:                    
		            break;
		        case self::WRITE_END:                
		            $comment->username = Param::get('username');
		            $comment->body = Param::get('body');
		            try {            
		                $comment->write($threadId, Param::get('username'), Param::get('body'));
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

	    public function write_end()
	    {
	    }
	}

?>
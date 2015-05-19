<?php
	class CommentController extends AppController
	{
		public function write()                        
	    {
	        $thread = Thread::get(Param::get('thread_id'));
	        $threadId = Param::get('thread_id');
	        $comment = new Comment;
	        $page = Param::get('page_next', 'write');
	        switch ($page) {
	        case 'write':                    
	            break;
	        case 'write_end':                
	            $comment->username = Param::get('username');
	            $comment->body = Param::get('body');
	            try {            
	                // $thread->write($comment);
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

	    // public function write()
	    // {
	    // 	$thread = Thread::get(Param::get('thread_id'));
	    	
	    //     $comment = new Comment;
	    //     $page = Param::get('page_next', 'write');
	    //     switch ($page) {
	    //     case 'write':                    
	    //         break;
	    //     case 'write_end':                
	    //         // $comment->username = Param::get('username');
	    //         // $comment->body = Param::get('body');
	        	
	    //     	$threadId = Param::get('thread_id');
	    //     	$username = Param::get('username');
	    //     	$body = Param::get('body');

	    //         try {            
	    //             // $thread->write($comment);
	    //             $comment->write($threadId, $username, $body);
	    //         } catch (ValidationException $e) {                    
	    //             $page = 'write';
	    //         }                        
	    //         break;
	    //     default:                    
	    //         throw new NotFoundException("{$page} is not found");        
	    //         break;
	    //     }
	    //     $this->set(get_defined_vars());
	    //     $this->render($page);

	    // }

	    public function write_end()
	    {
	    	// $thread = Param::get('thread_id');
	    	// $comment = new Comment();
	    }
	}

?>
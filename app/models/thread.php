<?php
class Thread extends AppModel                    
{
    public $validation = array(
        'title'=>array(
            'length'=>array(
                'validate_between',1,30),
            ),
          'body'=>array(
            'length'=>array(
                'validate_between',10,30),
            ),
        ); 

    public static function getAll($offset, $limit)                
    {
        $threads = array();
        $db = DB::conn();
        $rows = $db->rows("SELECT * FROM thread LIMIT {$offset}, {$limit}");
        
        foreach ($rows as $row) {                    
            $threads[] = new Thread($row);
        }
        
        return $threads;
    }   

    public static function getThreadsByCategory($categoryName)
    {
        
    }

    public function create(Comment $comment, $threadBody, $creator_id, $category)
    {
        $this->validate();
        $comment->validate();
        if( $this->hasError() || $comment->hasError()){
            throw new ValidationException('Invalid Thread or Comment');
        }

        $db = DB::conn();
        $db->begin();
        
        $params = array(
                'title'   => $this->title,
                'body' => $threadBody,
                'creator_id' => $creator_id,
                'category' => $category
        );

        $db->insert('thread',$params);
        $this->id = $db->lastInsertId();
        $this->write($comment);

        $db->commit();
    }


    public function update($threadId)
    {
        if(!$this->validate()) {
            throw new ValidationException("Invalid Input");
        }
        try {
            $db = DB::conn();
            $params = array(
                'title'   => $this->new_title,
                'body'    => $this->new_thread_body
            );
            $db->update('thread', $params, array('id' => $threadId));

        } catch(Exception $e) {
            throw $e;
        }

    }

    public static function deleteThreadById($thread_id)
    {
        $db = DB::conn();
        try {
            $db->query("DELETE FROM thread WHERE id = ?", array($thread_id));
        }
        catch (Exception $e) {
            throw $e; 
        }
    }

    // public function update()
    // {
    //     $db = DB::conn();
    //     $params = array(
    //         'title' => $this->new_title;
    //         'body'  => $this->new_body;
    //     );
    //     $db->update('thread', $params, array('id' => $this->id));
    // }

    public function write(Comment $comment)                    
    {
        $db = DB::conn();

        if(!$comment->validate()){
            throw new ValidationException('Invalid Comment');
        }
        else{
            $params = array(
                'thread_id' => $this->id,
                'username' => $comment->username,
                'body' => $comment->body
            );
            $db->insert('comment',$params);
        }
        
    }

    public static function get($id)            
    {
        $db = DB::conn();

        $row = $db->row('SELECT * FROM thread WHERE id = ?', array($id));

        if(!$row) {
            throw new RecordNotFoundException('no record found');
        }

        return new self($row);                    
    }

    public static function countAll()
    {
        $db = DB::conn();
        return $db->value("SELECT COUNT(*) FROM thread");
    }  


    public function getComments()
    {
        $comments = array();
        
        $db = DB::conn();
        $rows = $db->rows('SELECT * FROM comment WHERE thread_id = ? ORDER BY created ASC', array($this->id));

        foreach ($rows as $row) {                        
            $comments[] = new Comment($row);
        }
        return $comments;
    }

    public static function getTitle($id)
    {
        $db = DB::conn();
        $row = $db->row('SELECT title FROM thread WHERE id = ?', array($id));
        return $row;
    }

    public static function getBodyContents($id)
    {
        $db = DB::conn();
        $row = $db->row('SELECT body FROM thread WHERE id = ?', array($id));
        return $row;
    }    

    public static function getOwnerId($id)
    {
        $db = DB::conn();
        $row = $db->row('SELECT creator_id FROM thread WHERE id = ?', array($id));
        return $row['creator_id'];
    }


    public function isOwnedBy($username)
    {
        $db = DB::conn();
        $userId = User::getUserId($username);
        if($userId === $this->creator_id){
            return true;
        }
        else return false;
    }

    public static function getTopFive()
    {
        $db = DB::conn();
        $rows = $db->rows(
            'SELECT thread_id, count(*) as commentCount FROM comment GROUP BY thread_id ORDER BY commentCount DESC LIMIT 5');
        return $rows;
    }

                      
}
?>
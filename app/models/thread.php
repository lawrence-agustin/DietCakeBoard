<?php
class Thread extends AppModel                    
{
    const MIN_STRING_LENGTH = 5;
    const MAX_STRING_LENGTH = 200;

    public $validation = array(
        'title'=>array(
            'length'=>array(
                'validate_between', self::MIN_STRING_LENGTH, self::MAX_STRING_LENGTH),
                'exists' => array('threadExists')
        ),
        'body'=>array(
            'length'=>array(
                'validate_between', self::MIN_STRING_LENGTH, self::MAX_STRING_LENGTH),
        ),
        'new_title'=>array(
            'length'=>array(
                'validate_between', self::MIN_STRING_LENGTH, self::MAX_STRING_LENGTH),
        ),
        'new_thread_body'=>array(
            'length'=>array(
                'validate_between', self::MIN_STRING_LENGTH, self::MAX_STRING_LENGTH),
        ),
    ); 

    public static function getAll($offset, $limit)                
    {
        $threads = array();
        $db = DB::conn();
        $sql = sprintf("SELECT * FROM thread LIMIT %d, %d", $offset, $limit);
        $rows = $db->rows($sql);
        foreach ($rows as $row) {                    
            $threads[] = new Thread($row);
        }
        return $threads;
    }   

    public function create(Comment $comment, $creator_id, $category)
    {
        $this->validate();
        $comment->validate();
        if($this->hasError() || $comment->hasError()){
            throw new ValidationException('Invalid Input');
        }

        
        $db = DB::conn();
        $db->begin();
        
        $params = array(
                'title'         => $this->title,
                'body'          => $this->body,
                'creator_id'    => $creator_id,
                'category'      => $category
        );

        $db->insert('thread',$params);
        $this->id = $db->lastInsertId();
        $this->write($comment);

        $db->commit();
    }

    public function update($threadId)
    {
        unset($this->title);
        unset($this->body);
        $this->validate();
        if($this->hasError()) {
            throw new ValidationException("Invalid Input");
        }

        $db = DB::conn();
        $params = array(
                'title'   => $this->new_title,
                'body'    => $this->new_thread_body
        );
        $db->update('thread', $params, array('id' => $threadId));
    }

    public static function deleteById($thread_id)
    {
        $db = DB::conn();
        try {
            $db->query("DELETE FROM thread WHERE id = ?", array($thread_id));
        }
        catch (Exception $e) {
            throw $e; 
        }
    }

    public function write(Comment $comment)                    
    {
        $db = DB::conn();

        if(!$comment->validate()){
            throw new ValidationException('Invalid Comment');
        }
        else {
            $params = array(
                'thread_id' => $this->id,
                'username' => $comment->username,
                'body' => $comment->body
            );
            $db->insert('comment', $params);
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

    public static function getTitle($id)
    {
        $db = DB::conn();
        $title = $db->value('SELECT title FROM thread WHERE id = ?', array($id));
        return $title;
    }

    public static function getBodyContents($id)
    {
        $db = DB::conn();
        $body = $db->value('SELECT body FROM thread WHERE id = ?', array($id));
        return $body;
    }    

    public static function getOwnerId($id)
    {
        $db = DB::conn();
        $value = $db->value('SELECT creator_id FROM thread WHERE id = ?', array($id));
        return $value;
    }

    public function isOwnedBy($username)
    {
        $db = DB::conn();
        $userId = User::getUserId($username);
        if($userId === $this->creator_id){
            return true;
        }
        
        return false;
    }

    public static function getThreadsByCategory($categoryName)
    {
        $db = DB::conn();
        $rows = $db->rows('SELECT * FROM thread WHERE category = ?', array($categoryName));
        foreach ($rows as $row) {                    
            $threads[] = new Thread($row);
        }
        return $threads;
    }

    public function threadExists($title)
    {
        $db = DB::conn();
        $row = $db->row('SELECT * FROM thread WHERE title = ? ', array($title));
        if (!$row) {
            return true;
        }
        return false;
    }           
}
?>
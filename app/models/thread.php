<?php
class Thread extends AppModel                    
{
    public $validation = array(
        'title'=>array(
            'length'=>array(
                'validate_between',1,30),
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

    public function create(Comment $comment)
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
                'created' => 'NOW()'
        );

        $db->insert('thread',$params);
        $this->id = $db->lastInsertId();
        $this->write($comment);

        $db->commit();
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

    public static function countAll()
    {
        $db = DB::conn();
        return $db->value("SELECT COUNT(*) FROM thread");
    }                          
}
?>
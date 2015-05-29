<?php
class Comment extends AppModel
{
    const MIN_STRING_LENGTH = 5;
    const MAX_STRING_LENGTH = 200;

    public $validation = array(
        'username' => array(
            'length' => array(
                'validate_between', self::MIN_STRING_LENGTH, self::MAX_STRING_LENGTH,
            ),
        ),
        'body' => array(                    
            'length' => array(                
                'validate_between', self::MIN_STRING_LENGTH, self::MAX_STRING_LENGTH,
            ),
        ),
    );

    public static function getAll($thread_id, $offset, $limit)                
    {
        $comments = array();
        $db = DB::conn();
        $sql = sprintf("SELECT * FROM comment WHERE thread_id = %d LIMIT %d, %d", $thread_id, $offset, $limit);
        $rows = $db->rows($sql);

        foreach ($rows as $row) {                    
            $comments[] = new self($row);
        }
        
        return $comments;
    }  

    public function write($thread_id, $username, $body)
    {
        $this->validate();
        if($this->hasError()){
            throw new ValidationException("Invalid Comment");
        }

        $db = DB::conn();
        $params = array(
            'id' => $this->id,
            'thread_id' => $thread_id,
            'username' => $username,
            'body' => $body
            );
        $db->insert('comment', $params);
        $this->id = $db->lastInsertId();
    }

    public static function countAll($thread_id)
    {
        $db = DB::conn();
        return $db->value("SELECT COUNT(*) FROM comment WHERE thread_id = ?", array($thread_id));
    }  

    public static function getTopFive()
    {
        $db = DB::conn();
        $rows = $db->rows(
            'SELECT thread_id, count(*) as commentCount FROM comment GROUP BY thread_id ORDER BY commentCount DESC LIMIT 10');
        return $rows;
    } 

    public static function getComments($thread_id)
    {
        $comments = array();
        $db = DB::conn();
        $rows = $db->rows('SELECT * FROM comment WHERE thread_id = ? ORDER BY created', array($thread_id));

        foreach ($rows as $row) {                        
            $comments[] = new Comment($row);
        }
        return $comments;
    }

    public static function deleteCommentsByThreadId($thread_id)
    {
        $db = DB::conn();
        try {
            $db->query("DELETE from comment WHERE thread_id = ?", array($thread_id));
        }
        catch (Exception $e) {
            throw $e;
        }
    }
}
?>
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
        $rows = $db->rows("SELECT * FROM comment WHERE thread_id = ? LIMIT {$offset}, {$limit}", array($thread_id)); //tried to use placeholder here, but it resulted to an error "PDO Exception"
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
        return $db->value("SELECT COUNT(*) FROM comment WHERE thread_id = ? ", array($thread_id));
    }  

    public static function getTopFive()
    {
        $db = DB::conn();
        $rows = $db->rows(
            'SELECT thread_id, count(*) as commentCount FROM comment GROUP BY thread_id ORDER BY commentCount DESC LIMIT 10');
        return $rows;
    } 

}
?>
<?php
class Comment extends AppModel
{
    public $validation = array(
        'username' => array(
            'length' => array(
                'validate_between', 8, 16,
            ),
        ),
        'body' => array(                    
            'length' => array(                
                'validate_between', 5, 200,
            ),
        ),
    );


    public static function getAll($thread_id, $offset, $limit)                
    {
        $comments = array();
        $db = DB::conn();
        $rows = $db->rows("SELECT * FROM comment WHERE thread_id = ? LIMIT {$offset}, {$limit}", array($thread_id));
        //$rows = $db->rows("SELECT * FROM comment WHERE thread_id = ? AND id = ?", array($thread_id, $comment_id));
        foreach ($rows as $row) {                    
            $comments[] = new Comment($row);
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

    // public function getComments($thread_id)
    // {
    //     $comments = array();
        
    //     $db = DB::conn();
    //     $rows = $db->rows('SELECT * FROM comment WHERE thread_id = ? ORDER BY created ASC', array($thread_id));

    //     foreach ($rows as $row) {                        
    //         $comments[] = new Comment($row);
    //     }
    //     return $comments;
    // }




    public static function countAll($thread_id)
    {
        $db = DB::conn();
        return $db->value("SELECT COUNT(*) FROM comment WHERE thread_id = ? ", array($thread_id));
    }   

    // public function __construct()
    // {
    //     $this->thread_id = "";
    //     $this->username = "";
    //     $this->body = "";
    // }

    // public function setCommentInfo($commentInfo)
    // {
    //     $this->thread_id = $commentInfo['thread_id'];
    //     $this->username = $commentInfo['username'];
    //     $this->body = $commentInfo['body'];
    // }

    // public function create()
    // {
    //     if(!$this->validate()){
    //         throw new ValidationException("Invalid Input");
            
    //     }

    //     try
    //     {
    //         $db = DB::conn();
    //         $params = array(
    //             'thread_id' => $this->thread_id,
    //             'username' => $this->username,
    //             'body' => $this->body,
    //             'created' => 'NOW',
    //             );
    //     }catch(Exception $e){
    //         throw $e;
    //     }

    // }



    // public static function getAll($thread_id)
    // {
    //     $comment = array();
    //     $db = DB::conn();
    //     $rows = $db->rows("SELECT * FROM comment WHERE thread_id = ?", $thread_id);

    //     foreach($rows as $row){
    //         $comment[] = new Comment($row);
    //     }

    //     return $comment;
    // }

    // public static function getUserId($username)
    // {
    //     $db = DB::conn();
    //     $row = $db->row("SELECT user_id FROM user WHERE username = ?", $username);
    //     return $row;
    // }


}
?>
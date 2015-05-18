<?php
class Comment extends AppModel
{
    public $validation = array(
        'username' => array(
            'length' => array(
                'validate_between', 1, 16,
            ),
        ),
        'body' => array(                    
            'length' => array(                
                'validate_between', 10, 200,
            ),
        ),
    );

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
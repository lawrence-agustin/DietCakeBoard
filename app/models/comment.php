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
                'validate_between', 1, 200,
            ),
        ),
    );

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
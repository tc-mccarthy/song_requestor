<?php
/*
Primary controller for song requestor
Author: TC McCarthy
*/

require_once(dirname(__FILE__) . "/ezSQL/shared/ez_sql_core.php");
require_once(dirname(__FILE__) . "/ezSQL/mysql/ez_sql_mysql.php");

class sr
{
    public function __construct()
    {
        $this->db = new ezSQL_mysql(getenv("MYSQL_USER"), getenv("MYSQL_PASS"), 'song_requestor', getenv("MYSQL_HOST"));

        $this->router();
    }

    public function router()
    {
        switch ($_GET['action']) {
          case 'request':
            $data = json_decode(file_get_contents("php://input"));
            $success = $this->submit_request($data);
            echo json_encode((object) array("success" => $success));
            break;
      }
    }

    public function submit_request($data)
    {
        $exists = $this->db->get_row("SELECT * FROM requests WHERE spotify_id = '{$data->spotify_id}'");

        foreach ($data as $key => $value) {
            $data->{$key} = addslashes($value);
        }

        if (is_null($exists)) {
            $this->db->query("
              INSERT INTO requests (spotify_id, artist, album, track)
              VALUES ('{$data->spotify_id}', '{$data->artist}', '{$data->album}', '{$data->track}')
          ");
        }

        $this->db->query("
            INSERT INTO requestors (spotify_id, first_name, last_name)
            VALUES ('{$data->spotify_id}', '{$data->first_name}', '{$data->last_name}')
        ");

        return true;
    }
}

$sr = new sr();

<?php

/*
CREATE TABLE `directus_preferences` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `user` int(11) DEFAULT NULL,
  `table_name` varchar(64) DEFAULT NULL,
  `title` varchar(255) DEFAULT NULL,
  `columns_visible` varchar(300) DEFAULT NULL,
  `sort` varchar(64) DEFAULT 'id',
  `sort_order` varchar(5) DEFAULT 'asc',
  `active` varchar(5) DEFAULT '3',
  `search_string` text,
  PRIMARY KEY (`id`),
  UNIQUE KEY `user` (`user`,`table_name`,`title`),
  UNIQUE KEY `pref_title_constraint` (`user`,`table_name`,`title`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
*/

use Ruckusing\Migration\Base as Ruckusing_Migration_Base;

class CreateDirectusPreferencesTable extends Ruckusing_Migration_Base
{
    public function up()
    {
      $t = $this->create_table("directus_preferences", array(
          "id"=>false,
        )
      );

      //columns
      $t->column("id", "integer", array(
          "unsigned"=>true,
          "null"=>false,
          "auto_increment"=>true,
          "primary_key"=>true
        )
      );
      $t->column("user", "integer", array(
          "unsigned"=>true,
          "default"=>NULL
        )
      );
      $t->column("table_name", "string", array(
          "limit"=>64,
          "default"=>NULL
        )
      );
      $t->column("title", "string", array(
          "limit"=>255,
          "default"=>NULL
        )
      );
      $t->column("columns_visible", "string", array(
          "limit"=>300,
          "default"=>NULL
        )
      );
      $t->column("sort", "string", array(
          "limit"=>64,
          "default"=>"id"
        )
      );
      $t->column("sort_order", "string", array(
          "limit"=>5,
          "default"=>"ASC"
        )
      );
      $t->column("active", "string", array(
          "limit"=>5,
          "default"=>3
        )
      );
      $t->column("search_string", "text");

      $t->finish();

      $this->add_index("directus_preferences", array("user","table_name", "title"), array(
        "unique"=>true,
        "name"=>"user"
        )
      );
      $this->add_index("directus_preferences", array("user","table_name", "title"), array(
        "unique"=>true,
        "name"=>"pref_title_constraint"
        )
      );
    }//up()

    public function down()
    {
      $this->remove_index("directus_preferences", array("user","table_name", "title"), array(
        "unique"=>true,
        "name"=>"user"
        )
      );
      $this->remove_index("directus_preferences", array("user","table_name", "title"), array(
        "unique"=>true,
        "name"=>"pref_title_constraint"
        )
      );
      $this->drop_table("directus_preferences");
    }//down()
}

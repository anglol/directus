<?php

/*
CREATE TABLE `directus_privileges` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `table_name` varchar(255) CHARACTER SET latin1 NOT NULL,
  `permissions` varchar(500) CHARACTER SET latin1 DEFAULT NULL COMMENT 'Table-level permissions (insert, delete, etc.)',
  `group_id` int(11) NOT NULL,
  `read_field_blacklist` varchar(1000) CHARACTER SET latin1 DEFAULT NULL,
  `write_field_blacklist` varchar(1000) CHARACTER SET latin1 DEFAULT NULL,
  `unlisted` tinyint(1) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
*/

use Ruckusing\Migration\Base as Ruckusing_Migration_Base;

class CreateDirectusPrivilegesTable extends Ruckusing_Migration_Base
{
    public function up()
    {
      $t = $this->create_table("directus_privileges", array(
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
      $t->column("table_name", "string", array(
          "limit"=>255,
          "null"=>false,
          "character"=>"latin1"
        )
      );
      $t->column("permissions", "string", array(
          "limit"=>500,
          "default"=>NULL,
          "character"=>"latin1",
          "COMMENT"=>"Table-level permissions (insert, delete, etc.)"
        )
      );
      $t->column("group_id", "integer", array(
          "unsigned"=>true,
          "null"=>false
        )
      );
      $t->column("read_field_blacklist", "string", array(
          "limit"=>1000,
          "default"=>NULL,
          "character"=>"latin1",
        )
      );
      $t->column("write_field_blacklist", "string", array(
          "limit"=>1000,
          "default"=>NULL,
          "character"=>"latin1",
        )
      );
      $t->column("unlisted", "tinyinteger", array(
          "limit"=>1,
          "default"=>NULL
        )
      );
      $t->column("status_id", "tinyinteger", array(
          "limit"=>1,
          "default"=>0,
          "null"=>false
        )
      );

      $t->finish();

      $tables = [
          'directus_activity',
          'directus_columns',
          'directus_groups',
          'directus_files',
          'directus_messages',
          'directus_preferences',
          'directus_privileges',
          'directus_settings',
          'directus_tables',
          'directus_ui',
          'directus_users',
          'directus_social_feeds',
          'directus_messages_recipients',
          'directus_social_posts',
          'directus_tab_privileges',
          'directus_bookmarks'
      ];

      foreach($tables as $table) {
          $this->insert('directus_privileges', [
              'table_name' => $table,
              'permissions' => 'add,edit,bigedit,delete,bigdelete,alter,view,bigview',
              'group_id' => 1,
              'read_field_blacklist' => NULL,
              'write_field_blacklist' => NULL,
              'unlisted' => NULL
          ]);
      }
    }//up()

    public function down()
    {
      $this->drop_table("directus_privileges");
    }//down()
}

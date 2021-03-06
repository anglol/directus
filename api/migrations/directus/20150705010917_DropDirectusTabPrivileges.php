<?php
use Ruckusing\Migration\Base as Ruckusing_Migration_Base;

class DropDirectusTabPrivileges extends Ruckusing_Migration_Base
{
    public function up()
    {
        $this->add_column('directus_groups', 'nav_override', 'text');

        $sql = 'UPDATE '.$this->get_adapter()->identifier('directus_groups');
        $sql.= ' SET '.$this->get_adapter()->identifier('nav_override').' = ';
        $sql.= ' (SELECT '.$this->get_adapter()->identifier('nav_override');
        $sql.= ' FROM '.$this->get_adapter()->identifier('directus_tab_privileges');
        $sql.= ' WHERE '.$this->get_adapter()->identifier('group_id').' = ';
        $sql.= ' '.$this->get_adapter()->identifier('id');
        $sql.= ' )';

        $this->execute($sql);

        $this->drop_table("directus_tab_privileges");
    }//up()

    public function down()
    {
        // we won't use this anymore
        $t = $this->create_table("directus_tab_privileges", array(
          "id"=>false,
          "options"=>""
        )
      );

      //columns
      $t->column("id", "integer", array(
          "limit"=>11,
          "unsigned"=>true,
          "null"=>false,
          "auto_increment"=>true,
          "primary_key"=>true
        )
      );
      $t->column("group_id", "integer", array(
          "limit"=>11,
          "default"=>NULL
        )
      );
      $t->column("tab_blacklist", "string", array(
          "limit"=>500,
          "default"=>NULL
        )
      );
      $t->column("nav_override", "text");

      $t->finish();
    }//down()

    protected function identifier($string)
    {
        return $this->get_adapter()->identifier($string);
    }
}

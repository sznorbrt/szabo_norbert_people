<?php 

defined('BASEPATH') OR exit('No direct script access allowed');

class Migration_Add_People_Table extends CI_Migration {

	public function __construct()
	{
		$this->load->dbforge();
		$this->load->database();
	}

	public function up()
	{
		$this->dbforge->add_field(array(
			'id' => array(
				'type' => 'INT',
				'auto_increment' => TRUE
			),
			'name' => array(
				'type' => 'VARCHAR',
				'constraint' => '150',
			),
			'email' => array(
				'type' => 'VARCHAR',
				'constraint' => '150',
				'uniquie' => TRUE,
			),
			'age' => array(
				'type' => 'INT',
				'constraint' => '2',
			),
			// 'created_at' => array(
			// 	'type' => 'TIMESTAMP',
			// 	'default' => 'CURRENT_TIMESTAMP',
			// ),
			// 'updated_at' => array(
			// 	'type' => 'TIMESTAMP',
			// 	'default' => 'CURRENT_TIMESTAMP',
			// ),
		));
		$this->dbforge->add_key('id', TRUE);
		$this->dbforge->create_table('people');
	}

	public function down()
	{
		$this->dbforge->drop_table('people');
	}
}
?>
<?php 

defined('BASEPATH') OR exit('No direct script access allowed');

class Migration_Seed_People_Table extends CI_Migration {

	public function __construct()
	{
		$this->load->dbforge();
		$this->load->database();
		$this->faker = Faker\Factory::create();
	}

	public function up()
	{
		// $vezeteknev = ['Nagy', 'Kovács', 'Tóth', 'Szabó', 'Horváth', 'Varga', 'Kiss', 'Molnár', 'Németh', 'Farkas'];
		// $keresztnev = ['Éva', 'Mária', 'Ildikó', 'Erika', 'Katalin', 'László', 'Zoltán', 'István', 'József', 'János'];
		// $email = ['gmail.com', 'yahoo.com', 'aol.com', 'andex.com', 'outlook.com', 'protonmail.com', 'ohomail.com', 'tutanota.com', 'icloud.com', 'bvhrs.com'];

		// for ($i=0; $i < 10; $i++) { 	
		// 	$people = [
		// 		$name = "name" => implode("", $this->faker->randomElements($vezeteknev)) . " " . implode("", $this->faker->randomElements($keresztnev)),
		// 		"email" => $this->faker->$name . "@" . implode("", $this->faker->randomElements($email)),
		// 		"age" => $this->faker->numberBetween(20, 80),
		// 	];
		// 	$this->db->insert('people', $people);
		// }

		for ($i=0; $i < 10; $i++) { 	
			$people = [
				"name" => $this->faker->name,
				"email" => $this->faker->email,
				"age" => $this->faker->numberBetween(20, 80),
			];
			$this->db->insert('people', $people);
		}
	}

	public function down()
	{
		$this->db->truncate('people');
	}
}
?>

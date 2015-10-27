<?php

class CategoryShell extends AppShell {

	public $uses = array("Category");

	public function index() {
		$this->out("id\tname");
		$categories = $this->Category->find("all");
		foreach ($categories as $category) {
			$this->out($category["Category"]["id"] ."\t". $category["Category"]["name"]); 
		}
	}
}

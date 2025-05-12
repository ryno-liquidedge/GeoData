<?php

namespace LiquidedgeApp\GeoData\model;

use LiquidedgeApp\GeoData\factory\Helper;

class Province {
	//--------------------------------------------------------------------------------
	// properties
	//--------------------------------------------------------------------------------
	protected string $name = "";
	//--------------------------------------------------------------------------------
	// functions
	//--------------------------------------------------------------------------------
	public function get_name(): string {
		return $this->name;
	}
	//--------------------------------------------------------------------------------
	private function set_name(string $name): void {
		$this->name = Helper::safe_name($name);
	}
	//--------------------------------------------------------------------------------
	public function parse_data($data):self {
		if(isset($data["admin_name"])) $this->set_name($data["admin_name"]);
		if(!$this->name && isset($data["ProvinceName"])) $this->set_name($data["ProvinceName"]);
		return $this;
	}
	//--------------------------------------------------------------------------------
}
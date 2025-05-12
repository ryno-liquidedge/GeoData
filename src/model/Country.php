<?php

namespace LiquidedgeApp\GeoData\model;

use LiquidedgeApp\GeoData\factory\Helper;

class Country {
	//--------------------------------------------------------------------------------
	// properties
	//--------------------------------------------------------------------------------
	protected string $name;
	protected string $code_alpha_2;
	protected string $code_alpha_3;

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
	public function get_code_alpha_2(): string {
		return $this->code_alpha_2;
	}
	//--------------------------------------------------------------------------------
	public function get_code_alpha_3(): string {
		return $this->code_alpha_3;
	}
	//--------------------------------------------------------------------------------
	public function parse_data($data): self {
		if(isset($data["country"])) $this->set_name($data["country"]);
		if(isset($data["iso2"])) $this->code_alpha_2 = $data["iso2"];
		if(isset($data["iso3"])) $this->code_alpha_3 = $data["iso3"];
		return $this;
	}
	//--------------------------------------------------------------------------------
}
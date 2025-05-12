<?php

namespace LiquidedgeApp\GeoData\model;

use LiquidedgeApp\GeoData\factory\Helper;

class City {
	//--------------------------------------------------------------------------------
	// properties
	//--------------------------------------------------------------------------------
	protected string $name;
	protected string $lat;
	protected string $lng;

	//--------------------------------------------------------------------------------
	// functions
	//--------------------------------------------------------------------------------
	public function get_name(): string {
		return $this->name;
	}
	//--------------------------------------------------------------------------------
	private function set_name(string $name): void {
		$this->name = Helper::safe_name(Helper::strip_special_chars($name));
	}
	//--------------------------------------------------------------------------------
	public function get_lat(): string {
		return $this->lat;
	}
	//--------------------------------------------------------------------------------
	private function set_lat(string $lat): void {
		$this->lat = $lat;
	}
	//--------------------------------------------------------------------------------
	public function get_lng(): string {
		return $this->lng;
	}
	//--------------------------------------------------------------------------------
	private function set_lng(string $lng): void {
		$this->lng = $lng;
	}
	//--------------------------------------------------------------------------------
	public function parse_data($data): self {
		if(isset($data["city"])) $this->set_name($data["city"]);
		if(isset($data["lat"])) $this->set_lat($data["lat"]);
		if(isset($data["lng"])) $this->set_lng($data["lng"]);
		return $this;
	}
	//--------------------------------------------------------------------------------
}
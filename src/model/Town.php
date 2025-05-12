<?php

namespace LiquidedgeApp\GeoData\model;

use LiquidedgeApp\GeoData\factory\Helper;

class Town {
	//--------------------------------------------------------------------------------
	// properties
	//--------------------------------------------------------------------------------
	protected string $name;
	protected Province $province;
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
		$this->name = Helper::safe_name($name);
	}
	//--------------------------------------------------------------------------------
	public function get_province(): Province {
		return $this->province;
	}
	//--------------------------------------------------------------------------------
	public function get_lat(): string {
		return $this->lat;
	}
	//--------------------------------------------------------------------------------
	public function get_lng(): string {
		return $this->lng;
	}
	//--------------------------------------------------------------------------------
	public function parse_data($data):self {
		if(isset($data["AccentCity"])) $this->set_name($data["AccentCity"]);
		if(isset($data["ProvinceName"])) $this->province = (new Province())->parse_data($data);
		if(isset($data["Latitude"])) $this->lat = $data["Latitude"];
		if(isset($data["Longitude"])) $this->lng = $data["Longitude"];
		return $this;
	}
	//--------------------------------------------------------------------------------
}
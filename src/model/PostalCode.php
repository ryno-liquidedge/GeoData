<?php

namespace LiquidedgeApp\GeoData\model;

use LiquidedgeApp\GeoData\factory\Helper;

class PostalCode {
	//--------------------------------------------------------------------------------
	// properties
	//--------------------------------------------------------------------------------
	protected string $name;
	protected string $postal_code;
	protected string $residential_code;
	protected string $town;
	protected string $province = "";
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
	public function get_postal_code(): string {
		return $this->postal_code;
	}
	//--------------------------------------------------------------------------------
	public function get_residential_code(): string {
		return $this->residential_code;
	}
	//--------------------------------------------------------------------------------
	public function get_town(): string {
		return $this->town;
	}
	//--------------------------------------------------------------------------------
	public function get_province(): string {
		return $this->province;
	}
	//--------------------------------------------------------------------------------
	public function parse_data($data):self {
		if(isset($data["SUBURB"])) $this->set_name($data["SUBURB"]);
		if(isset($data["STR-CODE"])) $this->residential_code = $data["STR-CODE"];
		if(isset($data["BOX-CODE"])) $this->postal_code = $data["BOX-CODE"];
		if(isset($data["AREA"])) $this->town = Helper::safe_name($data["AREA"]);

		if(!$this->residential_code) $this->residential_code = $this->postal_code;
		if(!$this->postal_code) $this->postal_code = $this->residential_code;

		switch (intval($this->residential_code)){
			case $this->residential_code >= 0001 && $this->residential_code <= 2199: $this->province = "Gauteng"; break;
			case $this->residential_code >= 2500 && $this->residential_code <= 2899: $this->province = "North West"; break;
			case $this->residential_code >= 500 && $this->residential_code <= 999: $this->province = "Limpopo"; break;
			case $this->residential_code >= 1000 && $this->residential_code <= 2499: $this->province = "Mpumalanga"; break;
			case $this->residential_code >= 2900 && $this->residential_code <= 4730: $this->province = "Kwazulu Natal"; break;
			case $this->residential_code >= 4731 && $this->residential_code <= 6499: $this->province = "Eastern Cape"; break;
			case $this->residential_code >= 6500 && $this->residential_code <= 8299: $this->province = "Western Cape"; break;
			case $this->residential_code >= 8300 && $this->residential_code <= 8999: $this->province = "Northern Cape"; break;
			case $this->residential_code >= 9300 && $this->residential_code <= 9999: $this->province = "Free State"; break;
		}

		return $this;
	}
	//--------------------------------------------------------------------------------
}
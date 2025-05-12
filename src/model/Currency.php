<?php

namespace LiquidedgeApp\GeoData\model;

use LiquidedgeApp\GeoData\factory\Helper;

class Currency {
	//--------------------------------------------------------------------------------
	// properties
	//--------------------------------------------------------------------------------
	protected string $name;
	protected string $country_name;
	protected string $country_code_alpha_2;
	protected string $country_code_alpha_3;
	protected string $currency_code_alpha_3;
	protected string $symbol;
	//--------------------------------------------------------------------------------
	// functions
	//--------------------------------------------------------------------------------
	public function get_name(): string {
		return $this->name;
	}
	//--------------------------------------------------------------------------------
	public function get_country_name(): string {
		return $this->country_name;
	}
	//--------------------------------------------------------------------------------
	public function get_country_code_alpha_2(): string {
		return $this->country_code_alpha_2;
	}
	//--------------------------------------------------------------------------------
	public function get_country_code_alpha_3(): string {
		return $this->country_code_alpha_3;
	}
	//--------------------------------------------------------------------------------
	public function get_currency_code_alpha_3(): string {
		return $this->currency_code_alpha_3;
	}
	//--------------------------------------------------------------------------------
	public function get_symbol(): string {
		return $this->symbol;
	}
	//--------------------------------------------------------------------------------
	private function set_name(string $name): void {
		$this->name = Helper::safe_name($name);
	}
	//--------------------------------------------------------------------------------
	private function set_country_name(string $country_name): void {
		$this->country_name = Helper::safe_name($country_name);
	}
	//--------------------------------------------------------------------------------
	private function set_symbol(string $symbol): void {
		$this->symbol = iconv("UTF-8", "ISO-8859-1//TRANSLIT", $symbol);
	}
	//--------------------------------------------------------------------------------
	public function parse_data($data):self {
		if(isset($data["Currency"])) $this->set_name($data["Currency"]);
		if(isset($data["Country"])) $this->set_country_name($data["Country"]);
		if(isset($data["Alpha-2"])) $this->country_code_alpha_2 = $data["Alpha-2"];
		if(isset($data["Alpha-3"])) $this->country_code_alpha_3 = $data["Alpha-3"];
		if(isset($data["Currency Symbol"])) $this->set_symbol($data["Currency Symbol"]);
		if(isset($data["Currency Alpha-3"])) $this->currency_code_alpha_3 = $data["Currency Alpha-3"];
		return $this;
	}
	//--------------------------------------------------------------------------------
}
<?php

namespace LiquidedgeApp\GeoData;

use LiquidedgeApp\GeoData\factory\Helper;
use LiquidedgeApp\GeoData\model\City;
use LiquidedgeApp\GeoData\model\Country;
use LiquidedgeApp\GeoData\model\Currency;
use LiquidedgeApp\GeoData\model\PostalCode;
use LiquidedgeApp\GeoData\model\Province;
use LiquidedgeApp\GeoData\model\Town;

class GeoData {
	//--------------------------------------------------------------------------------
	// functions
	//--------------------------------------------------------------------------------
	/**
	 * @param callable $fn
	 * @param array $options
	 * @return void
	 * @throws \Exception
	 *
	 * @example
	 * $geo_data->loop_countries(function(\LiquidedgeApp\GeoData\model\Country $country, \LiquidedgeApp\GeoData\model\Province $province, \LiquidedgeApp\GeoData\model\City $city, array $data) {
	 *     // implementation
	 * });
	 */
	public function loop_countries(callable $fn, array $options = []): void {

		(new \LiquidedgeApp\GeoData\factory\ParseAsset())
			->set_filename(__DIR__ . "/assets/country-city.csv")
			->run(function($data)use($fn){
				call_user_func(
					$fn,
					(new Country())->parse_data($data),
					(new Province())->parse_data($data),
					(new City())->parse_data($data),
					$data
				);
			}, $options);

	}
	//--------------------------------------------------------------------------------
	/**
	 * @param callable $fn
	 * @param array $options
	 * @return void
	 * @throws \Exception
	 *
	 * @example
	 * $geo_data->loop_currencies(function(\LiquidedgeApp\GeoData\model\Currency $currency, array $data) {
	 *     // implementation
	 * });
	 */
	public function loop_currencies(callable $fn, array $options = []): void {

		(new \LiquidedgeApp\GeoData\factory\ParseAsset())
			->set_filename(__DIR__ . "/assets/country-currency.csv")
			->run(function($data)use($fn){
				call_user_func($fn, (new Currency())->parse_data($data), $data);
			}, $options);

	}
	//--------------------------------------------------------------------------------
	/**
	 * @param callable $fn
	 * @param array $options
	 * @return void
	 * @throws \Exception
	 *
	 * @example
	 * $geo_data->loop_suburbs(function(\LiquidedgeApp\GeoData\model\Town $town, array $data) {
	 *     // implementation
	 * });
	 */
	public function loop_towns(callable $fn, array $options = []): void {

		(new \LiquidedgeApp\GeoData\factory\ParseAsset())
			->set_filename(__DIR__ . "/assets/sa-province-suburbs.csv")
			->run(function($data)use($fn){
				call_user_func($fn, (new Town())->parse_data($data), $data);
			}, $options);

	}
	//--------------------------------------------------------------------------------
	/**
	 * @param callable $fn
	 * @param array $options
	 * @return void
	 * @throws \Exception
	 *
	 * @example
	 * $geo_data->loop_postal_codes(function(\LiquidedgeApp\GeoData\model\PostalCode $postal_code, array $data) {
	 *     // implementation
	 * });
	 */
	public function loop_postal_codes(callable $fn, array $options = []): void {

		(new \LiquidedgeApp\GeoData\factory\ParseAsset())
			->set_filename(__DIR__ . "/assets/sa-province-suburbs-post-office-version.csv")
			->run(function($data)use($fn){
				call_user_func($fn, (new PostalCode())->parse_data($data), $data);
			}, $options);

	}
	//--------------------------------------------------------------------------------
}
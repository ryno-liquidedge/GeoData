<?php

namespace LiquidedgeApp\GeoData\factory;

class ParseAsset {
	//--------------------------------------------------------------------------------
	// properties
	//--------------------------------------------------------------------------------
	protected string $filename;
	protected array $data_arr = [];
	//--------------------------------------------------------------------------------
	// functions
	//--------------------------------------------------------------------------------
	/**
	 * @param string $filename
	 * @return ParseAsset
	 */
	public function set_filename(string $filename): self {
		$this->filename = $filename;
		return $this;
	}
	//--------------------------------------------------------------------------------

	/**
	 * @return array
	 * @throws \Exception
	 */
	public function get_data_arr(): array {

		if(!file_exists($this->filename)) throw new \Exception("File not found");

		return $this->to_data_arr($this->filename);
	}
	//--------------------------------------------------------------------------------

	/**
	 * @param callable $fn
	 * @param array $options
	 * @return void
	 * @throws \Exception
	 */
	public function run(callable $fn, array $options = []) {

		$data_arr = $this->get_data_arr();
		foreach ($data_arr as $data){
			call_user_func($fn, $data);
		}
	}
	//--------------------------------------------------------------------------------
	private function to_data_arr($filename): array {

		// Initialize an array to hold the parsed data
		$data = [];

		// Open the CSV file for reading
		if (($handle = fopen($filename, 'r')) !== false) {
			// Read the header row from the CSV file
			$header = fgetcsv($handle, 1000, ',');


			// Loop through the file line-by-line
			while (($row = fgetcsv($handle, 1000, ',')) !== false) {
				// Combine header with row values to create an associative array for each row
				$data[] = array_combine($header, $row);
			}

			// Close the file handle
			fclose($handle);

		}
		return $data;
	}
	//--------------------------------------------------------------------------------
}
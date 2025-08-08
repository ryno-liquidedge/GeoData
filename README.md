# GeoData Library

Welcome to the **GeoData** library! This library provides an easy-to-use solution for parsing and processing geographical and currency-related data using a callback-driven approach. The library is designed to handle data such as countries, provinces, cities, towns, postal codes, and currencies, making it ideal for applications where such structured geographical data is required.

---

## Key Features

- **Callback-based processing** – Allows you to define custom logic to handle various data structures on a per-record basis.
- **Support for multiple data types**:
  - **Countries, Provinces, and Cities**
  - **Currencies**
  - **Towns**
  - **Postal Codes**
- **Highly extensible and reusable** – Modify or extend functionality as per your project needs.
- Parses CSV files and maps data directly to custom model objects.
- Data-driven from assets, so you're not limited to specific data sources.

---

## Installation

To add this library to your project:

**Using Composer** (recommended):
```shell script
composer require liquidedge-app/geo-data
```

Alternatively, you can manually download or clone the repository and include it in your project.

---

## Basic Usage

The `GeoData` library exposes several methods for processing different types of geographical data. All methods accept a callback function as a parameter where you can define your custom logic for handling the data.

### Example: Processing Countries, Provinces, and Cities
```php
use LiquidedgeApp\GeoData\GeoData;
use LiquidedgeApp\GeoData\model\Country;
use LiquidedgeApp\GeoData\model\Province;
use LiquidedgeApp\GeoData\model\City;

$geoData = new GeoData();

$geoData->loop_countries(function (Country $country, Province $province, City $city, array $data) {
    echo "Country: " . $country->getName() . "\n";
    echo "Province: " . $province->getName() . "\n";
    echo "City: " . $city->getName() . "\n";
});
```

### Example: Processing Currencies
```php
use LiquidedgeApp\GeoData\GeoData;
use LiquidedgeApp\GeoData\model\Currency;

$geoData = new GeoData();

$geoData->loop_currencies(function (Currency $currency, array $data) {
    echo "Currency: " . $currency->getCode() . " - " . $currency->getName() . "\n";
});
```

### Example: Processing Towns
```php
use LiquidedgeApp\GeoData\GeoData;
use LiquidedgeApp\GeoData\model\Town;

$geoData = new GeoData();

$geoData->loop_towns(function (Town $town, array $data) {
    echo "Town: " . $town->getName() . "\n";
});
```

### Example: Processing Postal Codes
```php
use LiquidedgeApp\GeoData\GeoData;
use LiquidedgeApp\GeoData\model\PostalCode;

$geoData = new GeoData();

$geoData->loop_postal_codes(function (PostalCode $postalCode, array $data) {
    echo "Postal Code: " . $postalCode->getCode() . "\n";
});
```

---

## Directory Structure

The library follows a clean directory structure:

- **`factory`**: Contains helper classes, including `ParseAsset`, responsible for processing and parsing assets.
- **`model`**: Data models such as `Country`, `Currency`, `City`, `Province`, `PostalCode`, and `Town`. These classes define the data entities used in the library.
- **`assets`**: CSV data sources used by the library to parse and provide data. This is where files like `country-city.csv`, `country-currency.csv`, etc., are stored.

---

## Methods Overview

Below is a summary of the primary methods exposed by the `GeoData` class:

1. **`loop_countries()`**
   - Processes data for countries, provinces, and cities.
   - Parameters:
     - `callable $fn`: Your callback function to handle each data record.
     - `array $options`: Additional options for data parsing (optional).
   - Example use case: Extracting details of each country and its respective provinces/cities.

2. **`loop_currencies()`**
   - Processes currency data.
   - Parameters:
     - `callable $fn`: Your callback function to handle currency records.
     - `array $options`: Additional options for data parsing (optional).
   - Example use case: Extracting country currency information.

3. **`loop_towns()`**
   - Processes data for towns.
   - Parameters:
     - `callable $fn`: Your callback function to handle town records.
     - `array $options`: Additional options for data parsing (optional).
   - Example use case: Getting town details from CSV.

4. **`loop_postal_codes()`**
   - Processes data for postal codes.
   - Parameters:
     - `callable $fn`: Your callback function to handle records.
     - `array $options`: Additional options for data parsing (optional).
   - Example use case: Associating postal codes with towns or suburbs.

---

## Requirements

- **PHP 7.4 or higher**
- Ensure proper directory structure for `assets` to allow file parsing.

---

## Contributing

Contributions are welcome! Please follow these steps:

1. Fork the repository.
2. Create a feature branch: `git checkout -b feature-name`.
3. Make changes and test thoroughly.
4. Submit a pull request with a description of your changes.

---

## License

This project is licensed under the MIT License. See the [LICENSE](LICENSE) file for details.

---

## Acknowledgments

Special thanks to all contributors and open-source supporters who helped make this library possible.

---

Feel free to reach out with any feedback or issues on the [Issues](https://github.com/liquidedge-app/geodata/issues) page. Happy coding! 🚀

<?php

namespace LiquidedgeApp\GeoData\factory;

class Helper {
	//--------------------------------------------------------------------------------
	public static function safe_name($str): string {
		$str = transliterator_transliterate('Any-Latin; Latin-ASCII', $str);
		return ucwords(strtolower($str));
	}
	//--------------------------------------------------------------------------------
	public static function strip_special_chars(string $string): string {

		// Convert to ASCII by transliterating characters
		$string = iconv('UTF-8', 'ASCII//TRANSLIT//IGNORE', $string);

		// Remove any remaining non-alphanumeric characters (you can tweak this pattern as needed)
		$string = preg_replace('/[^A-Za-z0-9\s]/', '', $string);

		// Optionally trim and normalize whitespace
		$string = preg_replace('/\s+/', ' ', $string); // Replace multiple spaces with single space
		$string = trim($string);

        $string = self::strip_accents($string);

        // UTF-8 characters
        $utf8 = array(
            '/[áàâãªä]/u'   =>   'a', // letters with accents
            '/[ÁÀÂÃÄ]/u'    =>   'A', // letters with accents
            '/[ÍÌÎÏ]/u'     =>   'I', // letters with accents
            '/[íìîï]/u'     =>   'i', // letters with accents
            '/[éèêë]/u'     =>   'e', // letters with accents
            '/[ÉÈÊË]/u'     =>   'E', // letters with accents
            '/[óòôõºö]/u'   =>   'o', // letters with accents
            '/[ÓÒÔÕÖ]/u'    =>   'O', // letters with accents
            '/[úùûü]/u'     =>   'u', // letters with accents
            '/[ÚÙÛÜ]/u'     =>   'U', // letters with accents
            '/ç/'           =>   'c', // cedilla
            '/Ç/'           =>   'C', // cedilla
            '/ñ/'           =>   'n', // tilde
            '/Ñ/'           =>   'N', // tilde
            '/–/'           =>   '-', // UTF-8 hyphen to "normal" hyphen
            '/[’‘‹›‚]/u'    =>   ' ', // Literally a single quote
            '/[“”«»„]/u'    =>   ' ', // Double quote
            '/ /'           =>   ' ', // nonbreaking space (equiv. to 0x160)
        );
        return preg_replace(array_keys($utf8), array_values($utf8), $string);
    }
	//--------------------------------------------------------------------------------
	public static function strip_accents($string) {
		return strtr($string, [
			"Á" => "A",	"À" => "A", "Â" => "A", "Ã" => "A", "Å" => "A", "Ä" => "A",
			"á" => "a", "à" => "a", "â" => "a", "ã" => "a", "å" => "a", "ä" => "a",

			"Ç" => "C",
			"ç" => "c",

			"É" => "E", "È" => "E", "Ê" => "E", "Ë" => "E",
			"é" => "e", "è" => "e", "ê" => "e", "ë" => "e",

			"Í" => "I", "Ì" => "I", "Î" => "I", "Ï" => "I",
			"í" => "i", "ì" => "i", "î" => "i", "ï" => "i",

			"Ñ" => "N",
			"ñ" => "n",

			"Ó" => "O", "Ò" => "O", "Ô" => "O", "Õ" => "O", "Ö" => "O", "Ø" => "O",
			"ó" => "o", "ò" => "o", "ô" => "o", "õ" => "o", "ö" => "o", "ø" => "o",

			"Ú" => "U", "Ù" => "U", "Û" => "U", "Ü" => "U",
			"ú" => "u", "ù" => "u", "û" => "u", "ü" => "u",

			"Ý" => "Y",
			"ý" => "y", "ÿ" => "y",

			"Æ" => "AE", "æ" => "ae",
			"Ð" => "Eth", "ð" => "eth",
			"ß" => "sz",
			"þ" => "thorn",
			"±" => "+-",
		]);
	}
	//--------------------------------------------------------------------------------
}
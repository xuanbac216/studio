<?php



/**
 * Gets System API client instance
 * @return AitSystemApiClient
 */
function ait_get_system_api_client()
{
	return Ait\SystemApi\Client::getInstance();
}



/**
 * Checks if given string contains some placeholders
 * @param  string $string
 * @param  array  $placeholders
 * @return bool
 */
function ait_string_contains_system_placeholder($string, $placeholders)
{
	foreach((array) $placeholders as $needle => $val){
		if($needle !== '' && strpos($string, $needle) !== false) return true;
	}
	return false;
}



/**
 * Replaces placeholders in string with actual values
 * @param  string $value
 * @return string
 */
function ait_replace_system_placeholders($string)
{
	static $placeholders;

	if(empty($placeholders['{themes_count}'])){
		$placeholders = array(
			'{langs_count}'                        => '', // old var
			'{languages_count}'                    => '', // new var
			'{themes_count}'                       => '',
			'{plugins_count}'                      => '',
			'{assets_count}'                       => '',
			'{products_count}'                     => '',

			'{premium_subscription_price}'         => '',
			'{subscription_price}'                 => '', // old var
			'{business_subscription_price}'        => '', // new var
			'{single_subscription_price}'          => '',
			'{per_product_price}'                  => '',
			'{per_theme_price}'                    => '',

			'{total_themes_price}'                 => '',
			'{total_plugins_price}'                => '',
			'{total_assets_price}'                 => '',
			'{total_price}'                        => '',
			'{saving_premium_subscription_price}'  => '',
			'{saving_business_subscription_price}' => '',
		);
	}

	if(empty($string) or !is_string($string) or (is_string($string) and !ait_string_contains_system_placeholder($string, $placeholders))) return $string; // bail early

	static $apiData;

	$api = ait_get_system_api_client();

	if(is_null($apiData)){
		$response = $api->getModule('stats')->getStats();
		if($response->isSuccessful()){
			$apiData = $response->getData();
			$placeholders['{langs_count}']                        = $apiData->counts->languages;
			$placeholders['{languages_count}']                    = $apiData->counts->languages;
			$placeholders['{themes_count}']                       = $apiData->counts->themes;
			$placeholders['{plugins_count}']                      = $apiData->counts->plugins;
			$placeholders['{assets_count}']                       = $apiData->counts->assets;
			$placeholders['{products_count}']                     = $apiData->counts->products;

			$placeholders['{premium_subscription_price}']         = '$' . $apiData->prices->premium_subscription;
			$placeholders['{subscription_price}']                 = '$' . $apiData->prices->business_subscription;
			$placeholders['{business_subscription_price}']        = '$' . $apiData->prices->business_subscription;
			$placeholders['{single_subscription_price}']          = '$' . $apiData->prices->single_subscription;
			$placeholders['{per_product_price}']                  = '$' . $apiData->prices->per_product;
			$placeholders['{per_theme_price}']                    = '$' . $apiData->prices->per_theme;

			$placeholders['{total_themes_price}']                 = '$' . $apiData->prices->total_themes;
			$placeholders['{total_plugins_price}']                = '$' . $apiData->prices->total_plugins;
			$placeholders['{total_assets_price}']                 = '$' . $apiData->prices->total_assets;
			$placeholders['{total_price}']                        = '$' . $apiData->prices->total;
			$placeholders['{saving_premium_subscription_price}']  = '$' . $apiData->prices->saving_premium_subscription;
			$placeholders['{saving_business_subscription_price}'] = '$' . $apiData->prices->saving_business_subscription;
		}
	}

	$string = str_replace(array_keys($placeholders), array_values($placeholders), $string);

	return $string;
}

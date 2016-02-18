<?php
class Reco {

	private $_apiUrl;
	private $_apiKey;
	private $_companyId;
	private $_atts;

	public function __construct($apiKey, $companyId, $atts) {
		$this->_apiKey = $apiKey;
		$this->_companyId = $companyId;
		$this->_apiUrl = "https://api.reco.se/venue/";
		$this->_atts = $atts;
	}

	public function getReviews($numItems = 0, $reviewSort = "DESC") {

		/*
		example url's
https://api.reco.se/venue/3725227/reviews?from=2016-01-01&to=2016-02-28&limit=10&apiKey=[key]
https://api.reco.se/venue/3725227/employee/1956/reviews?apiKey=[key]
			*/
		$baseUrl = $this->_apiUrl . $this->_companyId;

		if(isset($this->_atts['employeeid']) && $this->_atts['employeeid'] != '0' && is_numeric($this->_atts['employeeid'])) {
				$baseUrl = $baseUrl . "/employee/" . $this->_atts['employeeid'] . "/reviews?apiKey=" . $this->_apiKey;
		}else {
				$baseUrl .= '/reviews?apiKey=' . $this->_apiKey;
			}

		if($this->_atts['last-days'] == 'false')
		{
			if(isset($this->_atts['to']) && isset($this->_atts['from'])){
					$baseUrl .= "&from=" . $this->_atts['from'] . "&to=" . $this->_atts['to'];

			}
		}elseif(is_numeric($this->_atts['last-days'])) {

						$date = strtotime(date("Y-m-d"));
						$date = strtotime("-" . $this->_atts['last-days'] . " day", $date);
						$baseUrl .= "&from=" . date("Y-m-d",$date) . "&to=" . date("Y-m-d");
	}

		if(isset($this->_atts['limit']) && is_numeric($this->_atts['limit'])) {
				$baseUrl .= "&limit=" . $this->_atts['limit'];
		}

		$url = $baseUrl;
		$reviewList = $this->_fetchUrl($url);

		if(empty($reviewList)) {
			return;
		}
		return json_decode($reviewList);
	}

	public function decodeDate($date) {
		return strftime("%Y-%m-%d", ($date / 1000));

	}

	private function _fetchUrl($url) {
		//error_log("URL: " . $url);
		$url = str_replace(" ","",$url); // this is due to the fact that some servers add a whitespace before the & sign..

		$response = wp_remote_get($url);

		if(isset($this->_atts['random-reviews']) && $this->_atts['random-reviews'] == 'true') {
				$new_array = json_decode($response['body'],true);
				$tmp = array_shift($new_array);
				shuffle($new_array['reviews']);
				$new_array = json_encode($new_array);
				return $new_array;
			}else {
				return $response['body']; // use the content
			}
	}

}

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
		$url = sprintf("%s%s/reviews?apiKey=%s&limit=%d", // Needs to be to avoid php converting & to &amp;
		$this->_apiUrl,
		$this->_companyId,
		$this->_apiKey,
		$numItems);


		/*
https://api.reco.se/venue/3725227/reviews?from=2016-01-01&to=2016-02-28&limit=10&apiKey=4dccee071e0c7d587615f8a40dbe4cc7
https://api.reco.se/venue/3725227/employee/1956/reviews?apiKey=4dccee071e0c7d587615f8a40dbe4cc7
			*/
			$baseUrl = $this->_apiUrl . $this->_companyId;

			if(isset($this->_atts['employeeid']) && $this->_atts['employeeid'] != '0' && is_numeric($this->_atts['employeeid'])) {
					$baseUrl = $baseUrl . "/employee/" . $this->_atts['employeeid'] . "/reviews?apiKey=" . $this->_apiKey;
				}

			if(isset($this->_atts['to']) && isset($this->_atts['from'])){
					$baseUrl .= "&from=" . $this->_atts['from'] . "&to=" . $this->_atts['to'];

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
		error_log("URL: " . $url);
		$url = str_replace(" ","",$url); // this is due to the fact that some servers add a whitespace before the & sign..

		$response = wp_remote_get($url);

		if(isset($this->_atts['random-reviews']) && $this->_atts['random-reviews'] == 'true') {
				//error_log(var_dump($response['body']));

				//$tmp_array = json_decode($response['body'],true);
				//$this->shuffle_assoc($tmp_array);
				//shuffle($tmp_array);
				//$tmp_array = $this->shuffle_assoc($tmp_array);

				return $response['body']; // function not ready
				//return json_encode($tmp_array,true);
		}else {
			return $response['body']; // use the content
		}
	}

	private function shuffle_assoc($list) {
	  if (!is_array($list)) return $list;

	  $keys = array_keys($list);
	  shuffle($keys);
	  $random = array();
	  foreach ($keys as $key) {
	    $random[$key] = $list[$key];
	  }
	  return $random;
	}
}

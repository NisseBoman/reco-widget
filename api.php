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

	public function getReviews($numItems = 0, $atts, $reviewSort = "DESC") {
		$url = sprintf("%s%s/reviews?apiKey=%s&limit=%d", // Needs to be to avoid php converting & to &amp;
		$this->_apiUrl,
		$this->_companyId,
		$this->_apiKey,
		$numItems);


		/*
		array(
			'random-reviews' => 'false', // For showing random random-reviews
			'latest' => 'true', // Show only latest/last combined with latest-num
			'latest-num' => '5', // see above comment
			'employeeId' => 'false' // if blank show all employeeId separate with comma


https://api.reco.se/venue/3725227/reviews?from=2016-01-01&to=2016-02-28&limit=10&apiKey=4dccee071e0c7d587615f8a40dbe4cc7

https://api.reco.se/venue/3725227/employee/1956/reviews?apiKey=4dccee071e0c7d587615f8a40dbe4cc7
			*/
			$baseUrl = $this->_apiUrl . $this->_companyId;

			if(isset($atts['employeeId']) && $atts['employeeId'] != 'false') {
				$new_url = $baseUrl . "/employee/" . $atts['employeeId'] . "/reviews?apiKey=" . $this->_apiKey;
				$url = $new_url;

			}
			error_log("employeeId: " . $atts['employeeId']);




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
		$url = str_replace(" ","",$url);

		$response = wp_remote_get($url);
		error_log("BODY: " . $response['body']);
		return $response['body']; // use the content

		//return file_get_contents($url,FILE_TEXT);
	}
}

<?php
class Reco {

	private $_apiUrl;
	private $_apiKey;
	private $_companyId;

	public function __construct($apiKey, $companyId) {
		$this->_apiKey = $apiKey;
		$this->_companyId = $companyId;
		$this->_apiUrl = "https://api.reco.se/venue/";
	}

	public function getReviews($numItems = 0, $atts, $reviewSort = "DESC") {
		$url = sprintf("%s%s/reviews?apiKey=%s &limit=%d", // Needs to be to avoid php converting & to &amp;
		$this->_apiUrl,
		$this->_companyId,
		$this->_apiKey,
		$numItems);


		error_log("URL::" . $url);
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
		return file_get_contents($url,FILE_TEXT);
	}
}
function bidUpdate() {
	var currentTime = new Date().getTime();
	var startTime = new Date('" . $startTime . "').getTime();
	var endTime = new Date('" . $endTime . "').getTime();
	document.getElementById('currentTime').innerHTML = 'Current Time: ' + new Date().toLocaleString();
								
	if (currentTime < startTime) {
		document.getElementById('biddingStatus').innerHTML = 'Bidding Status: Bidding Starts at: " . $startTime . "';
		document.getElementById('bidButton').disabled = true;
		document.getElementById('bidButton+').disabled = true;
		document.getElementById('bidButton-').disabled = true;
	} 
								
	else if (currentTime >= startTime && currentTime <= endTime){
		if ($userBid === $highestBid) {
			document.getElementById('biddingStatus').innerHTML = 'Bidding Status: Bidding in progress. Bidding will ends at " . $endTime . "';
			document.getElementById('currentResult').innerHTML = '<p>You have the current highest bid of Rs." . $highestBid . ".</p>';
			document.getElementById('bidButton').disabled = true;
			document.getElementById('bidButton+').disabled = true;
			document.getElementById('bidButton-').disabled = true;
			} 
										
		else{
			document.getElementById('bidButton').disabled = false;
			document.getElementById('bidButton+').disabled = false;
			document.getElementById('bidButton-').disabled = false;
		} 
	}
									
	else {
		document.getElementById('biddingStatus').innerHTML = 'Bidding Status: Bidding Ended at " . $endTime . "';
		document.getElementById('bidButton').disabled = true;
		document.getElementById('bidButton+').disabled = true;
		document.getElementById('bidButton-').disabled = true;

		if ($userBid === $highestBid) {
			document.getElementById('currentResult').innerHTML = '<p>You have won the bid with a bid of Rs." . $highestBid . "</p>';
		} 
		else {
			document.getElementById('currentResult').innerHTML = '<p>You have lost the bid.</p>';
		}
	}
}
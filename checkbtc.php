#!/usr/bin/php
<?php
	date_default_timezone_set('America/Caracas');

	try{
		if($argv[1] == 'fee'){
			$btcfee = json_decode(file_contents("https://bitcoinfees.earn.com/api/v1/fees/recommended", true), true);

			echo "<< ".date(DATE_RFC2822)." >>\n";
			echo "\n";
			echo "Recomended Fee ";
			if(isset($argv[2])){
				$bytes = $argv[2];
				echo "for ".$bytes."bytes\n";
				echo "\tfastest Fee: BTC ".number_format(0.00000001*$btcfee['fastestFee']*$bytes, 8)." BTC [".$btcfee['fastestFee']." sat/byte]\n";
				echo "\t30min Fee:   BTC ".number_format(0.00000001*$btcfee['halfHourFee']*$bytes, 8)." BTC [".$btcfee['halfHourFee']." sat/byte]\n";
				echo "\t1hour Fee:   BTC ".number_format(0.00000001*$btcfee['hourFee']*$bytes, 8)." BTC [".$btcfee['hourFee']." sat/byte]\n";
			}else{
				echo "\n";
				echo "\tfastest Fee: ".$btcfee['fastestFee']." sat/byte\n";
				echo "\t30min Fee:   ".$btcfee['halfHourFee']." sat/byte\n";
				echo "\t1hour Fee:   ".$btcfee['hourFee']." sat/byte\n";
			}
			echo "\n";
			echo "source [https://bitcoinfees.earn.com/]\n\n";

		}else if($argv[1] == 'btc' || $argv[1] == 'usd' || $argv[1] == 'ves'){
			$json_result = json_decode(file_contents("https://localbitcoins.com/bitcoinaverage/ticker-all-currencies/", true), true);
			$v = $json_result["VES"];

			$lbtc = (isset($v['avg_1h']) ? $v['avg_1h'] : (isset($v['avg_6h']) ? $v['avg_6h'] : ( isset($v['avg_12h']) ? $v['avg_12h'] : ( isset($v['avg_24h']) ? $v['avg_12h'] : NULL ) ) ) );

			//$json_result["VES"]["avg_1h"];
			$lbtc_24h = $json_result["VES"]["avg_24h"];

			$json_result = json_decode(file_contents("https://api.coinmarketcap.com/v1/ticker/bitcoin/", true), true);
			$cmc = $json_result[0]["price_usd"];
			$cmc_percent_change_24h = $json_result[0]["percent_change_24h"];

			$json_result = json_decode(utf8_decode(file_get_contents("https://s3.amazonaws.com/dolartoday/data.json", true)), true);
			$dt = $json_result["USD"]["dolartoday"];

			try {
				$airtm = check_airtm('VES');
			} catch (\Exception $e) {
				$airtm = null;
			}

			$value = isset($argv[2]) ? $argv[2] : 0;
			if($value > 0){
				if($argv[1] == 'btc'){
					$valueBTC = $value;
					$valueUSD = $value*$cmc;
					$valueVES = $value*$lbtc;
				}else if($argv[1] == 'usd'){
					$valueBTC = $value/$cmc;
					$valueUSD = $value;
					$valueVES = $value*$dt;
				}else if($argv[1] == 'ves'){
					$valueBTC = $value/$lbtc;
					$valueUSD = $value/$dt;
					$valueVES = $value;
				}
			}

			$cmc_change = frmt_signal($cmc_percent_change_24h, 1).'%';
			$lbtc_change = frmt_signal((($lbtc - $lbtc_24h)*100)/$lbtc_24h, 1).'%';
			$dt_change = null;
			$lbtc_usd_change = null;
			//$lbtc_usd_change = frmt_signal($lbtc_24h/( $cmc - (($cmc_percent_change_24h * $cmc) / 100 )));


			echo "<< ".date(DATE_RFC2822)." >>\n";
			echo "\n";
			echo "1 BTC = USD " . frmt($cmc) . "\t".$cmc_change."\t(cmc)\n";
			echo "        VES " . frmt($lbtc) . "\t".$lbtc_change."\t(lbtc)\n";
			echo "\n";
			echo "1 USD = VES " . frmt($dt) . "\t\t(dt)\n";
			echo "        VES " . @frmt($airtm['rate']) . "\t\t(airtm)\n";
			echo "        VES " . frmt($lbtc/$cmc) . "\t\t(lbtc/cmc)\n";
			echo "\n";
			if($value > 0){
				echo "CONVER. BTC ".frmt($valueBTC, 8)."\n";
				echo "        USD ".frmt($valueUSD)."\n";
				echo "        VES ".frmt($valueVES)."\n";
				echo "\n";
				echo "https://bitcoincalc.github.io/?".$argv[1]."=".$value."\n";
			}else{
				echo "https://bitcoincalc.github.io/\n";
			}


		}else if($argv[1] == 'wallet'){
			// check wallet 1KcQit8NSsqAeneSQG2emCtmog8dJpzv83
			$sat = file_get_contents("https://blockchain.info/q/addressbalance/".$argv[2]."?confirmations=6", true);
			$balance = $sat*0.00000001;
			echo system($argv[0].' btc '.$balance);

		}else if($argv[1] == 'price'){

			if(isset($argv[2]) && ($argv[2] == 'localbtc' || $argv[2] == 'localbitcoins' || $argv[2] == 'lbtc' )){

				$json_result = json_decode(file_contents("https://localbitcoins.com/bitcoinaverage/ticker-all-currencies/", true), true);
				$currency = (isset($argv[3]) ? $argv[3] : 'VES');
				$result = $json_result[$currency];
				echo "<< ".date(DATE_RFC2822)." >>\n";
				echo "\n";
				echo "localbitcoins.com price [".$currency."]: \n";
				echo "\tVolume BTC\t".@$result['volume_btc']."\n";
				echo "\tavg 24h\t\t".@$result['avg_24h']."\n";
				echo "\tavg 12h\t\t".@$result['avg_12h']."\n";
				echo "\tavg 6h\t\t".@$result['avg_6h']."\n";
				echo "\tavg 1h\t\t".@$result['avg_1h']."\n";
				echo "\tlast rate\t".@$result['rates']['last']."\n";
				echo "\n";

			}else if(isset($argv[2]) && ($argv[2] == 'cmc' || $argv[2] == 'coinmarketcap')){
				$currency = (isset($argv[3]) ? $argv[3] : 'bitcoin');

				$json_result = json_decode(file_contents("https://api.coinmarketcap.com/v1/ticker/", true), true);
				$data = null;
				foreach($json_result as $result){
					if($result['id'] == $currency || $result['symbol'] == $currency){
						$data = $result;
						break;
					}
				}

				if(!empty($data)){
					echo "<< ".date(DATE_RFC2822)." >>\n";
					echo "\n";
					echo "coinmarketcap.com price ".$data['name'].": \n";
					echo "\tRank\t".@$data['rank']."\n";
					echo "\tUSD\t".@$data['price_usd']."\n";
					echo "\tBTC\t".@$data['price_btc']."\n";
					echo "\t1h\t".@frmt_signal($data['percent_change_1h'])."%\n";
					echo "\t24h\t".@frmt_signal($data['percent_change_24h'])."%\n";
					echo "\t7d\t".@frmt_signal($data['percent_change_7d'])."%\n";
					echo "\n";
				}

			}else if(isset($argv[2]) && ($argv[2] == 'dt' || $argv[2] == 'dolartoday')){
				$data = json_decode(utf8_decode(file_get_contents("https://s3.amazonaws.com/dolartoday/data.json", true)), true);

					echo "<< ".date(DATE_RFC2822)." >>\n";
					echo "\n";
					echo "dolartoday.com price: \n";
					echo "\t\t\tdolar\t\teuro\n";
					echo "\tdolartoday\t".@frmt($data['USD']['dolartoday'])."\t".@frmt($data['EUR']['dolartoday'])."\n";
					echo "\timplicito\t".@frmt($data['USD']['efectivo'])."\t\t".@frmt($data['EUR']['efectivo'])."\n";
					echo "\tdicom\t\t".@frmt($data['USD']['sicad2'])."\t".@frmt($data['EUR']['sicad2'])."\n";
					echo "\tcucuta\t\t".@frmt($data['USD']['efectivo_cucuta'])."\t".@frmt($data['EUR']['efectivo_cucuta'])."\n";
					echo "\n";


			}else{
				echo system($argv[0].' help');
			}


		}else if($argv[1] == 'airtm'){
			$currency = (!empty($argv[2]) ? strtoupper($argv[2]) : 'VES');

			$data = check_airtm($currency);

			echo "<< ".date(DATE_RFC2822)." >>\n";
			echo "\n";
			echo "airtm.io price: \n";
			echo "\t".$data['name']."\n";
			echo "\tUSD ".@frmt($data['rate'])."\n";
			echo "\n";

		}else if($argv[1] == 'uphold'){
			$result = json_decode(utf8_decode(file_get_contents("https://api.uphold.com/v0/ticker/USD", true)), true);

			foreach ($result as $data) {
				if($data['pair'] == 'BTCUSD') break;
			}

			$price = ($data['bid']+$data['ask'])/2;

			echo "<< ".date(DATE_RFC2822)." >>\n";
			echo "\n";
			echo "uphold.com price BTC:\n";
			echo "\tUSD  ".frmt($price)."\n";
			echo "\n";
			if(!empty($argv[2])){
				$value = $argv[2];
				echo "\tBTC  ".frmt($value, 8)."\n";
				echo "\tUSD  ".frmt($price*$value, 2)."\n";
				echo "\n";
			}

			if(!empty($out)){
				return $out;
			}else{
				return "Not found!";
			}

		}else{
			echo $argv[0]."\n";
			echo "Usage:\n";
			echo "\tbtc <value>\t\tcheck from btc convertions\n";
			echo "\tusd <value>\t\tcheck from usd convertions\n";
			echo "\tves <value>\t\tcheck from ves convertions\n";
			echo "\tfee\t\t\tcheck btc fee\n";
			echo "\tfee [bytes]\t\tcheck btc fee for bytes\n";
			echo "\twallet [public_key]\tpublic key from wallet or multiple public keys separated by pipe character \"|\"\n";
			echo "\tprice [source]\t\tcheck prices for a diferent api (can be lbtc|cmc|dt)\n";
			echo "\tairtm [currency]\t\tcheck AirTM prices\n";
			echo "\thelp\t\tthis message\n\n";

		}

	} catch (Exception $e) {
		echo $e->getMessage()."\n";
	}

	function file_contents($path) {
		  $str = @file_get_contents($path);
		  if ($str === FALSE) {
		      throw new Exception("Cannot access '$path' to read contents.");
		  } else {
		      return $str;
		  }
	}

	function frmt($number , $decimals = 2 , $dec_point = "." , $thousands_sep = ""){
		if(!empty($number)){
			return number_format($number, $decimals, $dec_point, $thousands_sep);
		}
		return '[error]';
	}

	function frmt_signal($number, $decimals = 2){
		if($number < 0){
			return frmt($number, $decimals);
		}else if($number > 0){
			return "+".frmt($number, $decimals);
		}else{
			return " ".frmt($number, $decimals);
		}
	}

	function check_airtm($currency = 'VES'){
		$result = explode("\n", file_contents("https://airtmrates.com/rates", true));

		foreach ($result as $item) {
			$keys = array('code', 'name', 'method', 'category', 'rate', 'buy', 'sell');
			$data = array_combine( $keys, explode(',', $item));
			if($data['code'] == $currency){
				break;
			}
		}

		return $data;
	}

?>

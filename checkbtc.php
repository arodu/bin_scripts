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
				echo "\tfastest Fee: BTC ".(0.00000001*$btcfee['fastestFee']*$bytes)." (".$btcfee['fastestFee']." sat/byte)\n";
				echo "\t30min Fee:   BTC ".(0.00000001*$btcfee['halfHourFee']*$bytes)." sat (".$btcfee['halfHourFee']." sat/byte)\n";
				echo "\t1hour Fee:   BTC ".(0.00000001*$btcfee['hourFee']*$bytes)." sat (".$btcfee['hourFee']." sat/byte)\n";
			}else{
				echo "\n";
				echo "\tfastest Fee: ".$btcfee['fastestFee']." sat/byte\n";
				echo "\t30min Fee:   ".$btcfee['halfHourFee']." sat/byte\n";
				echo "\t1hour Fee:   ".$btcfee['hourFee']." sat/byte\n";
			}
			echo "\n";
			echo "source [https://bitcoinfees.earn.com/]\n\n";
			
		}else if($argv[1] == 'btc' || $argv[1] == 'usd' || $argv[1] == 'vef'){
			$json_result = json_decode(file_contents("https://localbitcoins.com/bitcoinaverage/ticker-all-currencies/", true), true);
			$lbtc = $json_result["VEF"]["avg_1h"];

			$json_result = json_decode(file_contents("https://api.coinmarketcap.com/v1/ticker/bitcoin/", true), true);
			$cmc = $json_result[0]["price_usd"];

			$json_result = json_decode(utf8_decode(file_get_contents("https://s3.amazonaws.com/dolartoday/data.json", true)), true);
			$dt = $json_result["USD"]["dolartoday"];

			$value = $argv[2];
			if($argv[1] == 'btc'){
				$valueBTC = $value;
				$valueUSD = $value*$cmc;
				$valueVEF = $value*$lbtc;

			}else if($argv[1] == 'usd'){
				$valueBTC = $value/$cmc;
				$valueUSD = $value;
				$valueVEF = $value*$dt;

			}else if($argv[1] == 'vef'){
				$valueBTC = $value/$lbtc;
				$valueUSD = $value/$dt;
				$valueVEF = $value;

			}

			echo "<< ".date(DATE_RFC2822)." >>\n";
			echo "\n";
			echo "1 BTC = USD " . frmt($cmc) . " (CMC)\n";
			echo "        VEF " . frmt($lbtc) . " (LBTC)\n";
			echo "1 USD = VEF " . frmt($dt) . " (DT)\n";
			echo "        VEF " . frmt($lbtc/$cmc) . " (LBTC/CMC)\n";
			echo "\n";
			echo "CONVER. BTC ".frmt($valueBTC, 8)."\n";
			echo "        USD ".frmt($valueUSD)."\n";
			echo "        VEF ".frmt($valueVEF)."\n\n";

		}else if($argv[1] == 'wallet'){
			// check wallet 1KcQit8NSsqAeneSQG2emCtmog8dJpzv83
			$sat = file_get_contents("https://blockchain.info/q/addressbalance/".$argv[2], true);
			$balance = $sat*0.00000001;
			echo system($argv[0].' btc '.$balance);

		}else{
			echo $argv[0]."\n";
			echo "Usage:\n";
			echo "\tbtc <value>\t\tcheck from btc convertions\n";
			echo "\tusd <value>\t\tcheck from usd convertions\n";
			echo "\tvef <value>\t\tcheck from vef convertions\n";
			echo "\tfee\t\t\tcheck btc fee\n";
			echo "\tfee [bytes]\t\tcheck btc fee for bytes\n";
			echo "\twallet [public_key]\tpublic key from wallet or multiple public keys separated by pipe character \"|\"\n";
			echo "\thelp\t\tthis message\n";

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
		return number_format($number, $decimals, $dec_point, $thousands_sep);
	}

?>

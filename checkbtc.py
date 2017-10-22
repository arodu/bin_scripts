#!/usr/bin/python3

import urllib.request, json, sys
with urllib.request.urlopen("https://localbitcoins.com/bitcoinaverage/ticker-all-currencies/") as url:
	data = json.loads(url.read().decode())
	value = float(sys.argv[1]) * float(data["VEF"]["avg_1h"])
	print("Price last 1h: "+'{:06.2f}'.format(float(data["VEF"]["avg_1h"])))
	print("VEF: " + '{:06.2f}'.format(value))
	

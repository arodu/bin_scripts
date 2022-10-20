#!/usr/bin/env bash

cautoclick -i 55000 -n 320 -r 25000

#
# COMMAND LINE OPTIONS
#        These options only apply to  the  command  line  version  (cautoclick).
#        They are ignored by all GUI versions.
# 
#        --help display help and exit
#        -h
#        -help
# 
#        -i value
#               specify  the  interval,  which  is  the  time  between two mouse
#               clicks.  The time is specified in milliseconds (default:  1000).
# 
#        -n value
#               specify  the  number  of mouse clicks.  The time is specified in
#               milliseconds (default: 32).
# 
#        -p value
#               specify the pre-delay, which is the time the  application  waits
#               before  it  starts clicking.  The time is specified in millisec-
#               onds (default: 2000).
# 
#        -r value
#               specify a random factor.  For every click, a random time between
#               0  and  this  value  is added to or subtracted from the interval
#               time.  The time is specified in milliseconds (default: 0).
# 

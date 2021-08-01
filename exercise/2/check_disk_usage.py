#!/usr/bin/python

import psutil

hdd = psutil.disk_usage('/')

print (hdd)

print ("Total: %s GiB" % str(hdd.total / (2**30)))
print ("Used: %s GiB" % str(hdd.used / (2**30)))
print ("Free: %s GiB" % str(hdd.free / (2**30)))
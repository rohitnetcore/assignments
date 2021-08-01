#!/usr/bin/python

from os import walk

files = []
mypath = '/tmp/'

for (dirpath, dirnames, filenames) in walk(mypath):
    files.extend(filenames)
    break

print (files)
#!/usr/bin/python

import subprocess
import fetcher as f

server = 'localhost'
username = 'rohit'
password = 'rohit'

remoteDir = '/tmp/output_dir/'
localDir = '/tmp/input_dir/'
filename = 'test.csv'

# Upload using ftp

try:
  i = f.ftp(server,username,password)
  moved = i.ftpPut(localDir,remoteDir,filename)
  print (moved)
except Exception as e:
  print (e)

# Upload using sftp

try:
  i = f.sftp(server,username,password,22)
  moved = i.sftpPut(localDir,remoteDir,[filename])
  print (moved)
except Exception as e:
  print (e)

# Upload using scp

scp_cmd = "{}@{}:{}".format(username, server, remoteDir)
subprocess.run(["scp", "test.csv", scp_cmd])
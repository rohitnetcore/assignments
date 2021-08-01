#!/usr/bin/python

import spur

host = 'localhost'
user = 'rohit'
passwd = 'password'
cmd = ["echo", "-n", "hello"]

shell = spur.SshShell(hostname=host, username=user, password=passwd)
result = shell.run(cmd)
print (result.output)

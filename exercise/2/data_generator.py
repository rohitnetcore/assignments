import random
import sys
import myLogging as log
import dbconn as db

logging = log.init_logger('logs/generator.log','Sample DG')

class Site:

  def __init__(self):
    self.sapid = None
    self.hostname = None
    self.loopback = None
    self.macaddress = None

  def get_sapid(self):

    self.sapid = random.randint(100000000000,999999999999)

  def get_hostname(self):

    self.hostname = ".".join(map(str, (random.randint(0, 255) for _ in range(4))))

  def get_macaddress(self):

    self.macaddress = ':'.join(map(lambda x: "%04x" % x, [
      random.randint(0x00, 0x7f),
      random.randint(0x00, 0xff),
      random.randint(0x00, 0xff)
    ]))

  def get_loopback(self):

    self.loopback = "127.%s.%s.%s" % (
      random.randint(0, 255),
      random.randint(0, 255),
      random.randint(0, 255))

  def get_new_site(self):

    self.get_sapid()
    self.get_hostname()
    self.get_macaddress()
    self.get_loopback()

    return (self.sapid, 
      self.hostname,
      self.loopback,
      self.macaddress)


logging.info("Script started")

print("Enter any number (between 10 to 100): ")
num = int(input())
print("User Input is %s" % num)

if num >= 10 and num <= 100:

  records = []
  
  obj = Site()

  for i in range(num):
    records.append(obj.get_new_site())

  print (records)
  query = "INSERT INTO sites (sapid, hostname, loopback, macaddress) values (%s, %s, %s, %s)"
  db.dbinsert_many(query, records)
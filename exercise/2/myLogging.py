import logging
import logging.handlers

def init_logger(path,name):
  LOG_FILENAME = path
  log_rotator = logging.handlers.TimedRotatingFileHandler(LOG_FILENAME, when='midnight', interval=1,  encoding=None)
  logFormatter = logging.Formatter('%(asctime)s %(name)s %(message)s')
  log_rotator.setFormatter(logFormatter)
  logger = logging.getLogger(name)
  logger.setLevel(logging.DEBUG)
  if(logger.handlers==[]):
    logger.addHandler(log_rotator)
  return logger
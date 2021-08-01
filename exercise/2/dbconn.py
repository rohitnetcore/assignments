import mysql.connector.pooling
import sys, traceback

dbconfig = {
  "database": "assignments",
  "user": "root",
  "password": "",
  "host":"localhost",
  "port":"3306"
}

pool = mysql.connector.pooling.MySQLConnectionPool(pool_name = "mypool", pool_size = 3, **dbconfig)

def dbselect(query):
  cursor = None
  conn  = None
  try:
    conn = pool.get_connection()
    cursor = conn.cursor()
    a = cursor.execute(query)
    b = cursor.fetchall()
    return b
  except:
    exceptionType, exceptionValue, exceptionTraceback = sys.exc_info()
    errortrace =  ''.join( traceback.format_exception( *sys.exc_info() ) )
    raise
  finally:
    if cursor:
      cursor.close()
    if conn:
      conn.close()

def dbinsert(query):
  cursor = None
  conn  = None
  try:
    conn = pool.get_connection()
    cursor = conn.cursor()
    a = cursor.execute(query)
    rowcnt = cursor.rowcount
    cursor.execute('commit')
  except:
    exceptionType, exceptionValue, exceptionTraceback = sys.exc_info()
    errortrace =  ''.join( traceback.format_exception( *sys.exc_info() ) )
    print (errortrace)
    raise (exceptionType, exceptionValue, exceptionTraceback)
  finally:
    if cursor:
      cursor.close()
    if conn:
      conn.close()

def dbinsert_many(query,data):
  cursor = None
  conn  = None
  try:
    conn = pool.get_connection()
    cursor = conn.cursor()
    a = cursor.executemany(query,data)
    print (a)
    cursor.execute('commit')
  except:
    # Get the most recent exception
    exceptionType, exceptionValue, exceptionTraceback = sys.exc_info()
    #cursor.execute('rollback')
    errortrace =  ''.join( traceback.format_exception( *sys.exc_info() ) )
    print (errortrace)
    raise (exceptionType, exceptionValue, exceptionTraceback)
  finally:
    if cursor:
      cursor.close()
    if conn:
      conn.close()
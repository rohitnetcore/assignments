import paramiko
import ftplib
import os
import datetime

class sftp:
  def __init__(self,server,username,password,port,use_compression=False):
    self.trans = paramiko.Transport((server, port))
    if use_compression:
      self.trans.use_compression(True)
    self.trans.connect(username = username, password = password)
    self.sftp = paramiko.SFTPClient.from_transport(self.trans)

  def sftpClose(self):
    self.sftp.close()
    self.trans.close()
    return "SFTP connection closed"

  def sftpLs(self,ftpDirectory):
    it = self.sftp
    it.chdir(ftpDirectory)
    files=it.listdir()
    return files

  def sftpLsExt(self,ftpDirectory,extension):
    it = self.sftp
    it.chdir(ftpDirectory)
    files=it.listdir()
    return [f for f in files if f.endswith(extension)]

  def sftpGet(self,ftpDir,localDir,fileList):
    it = self.sftp
    for file in fileList:
      it.get(ftpDir+file,localDir+file)
    return "Files Downloaded"

  def sftpMove(self,source,destination,fileList):
    it = self.sftp
    now = datetime.datetime.now()
    filetime = now.strftime("%Y%m%d%H%M%S")
    #File movement
    for file in fileList:
      it.rename(source+file,destination+file+'_'+str(filetime)+'.done')
    return "File Moved"

  def sftpDel(self,ftpDir,fileList):
    it = self.sftp
    for file in fileList:
      it.remove(ftpDir+file)
    return "Files Deleted"

  def sftpPut(self,localDir,ftpDir,filelist):
    it = self.sftp
    for file in filelist:
      it.put(localDir+file,ftpDir+file)
    return "Files Uploaded"

class ftp:
  def __init__(self,server,username,password):
    self.ftp = ftplib.FTP(server)
    self.ftp.login(username, password)

  def ftpClose(self):
    self.ftp.close()
    return "FTP connection closed"

  def ftpLs(self,dir,filematch='*'):
    it = self.ftp
    it.cwd(dir)
    list = it.nlst(filematch)
    return list

  def ftpGet(self,ftpDir,localDir,filematch='*'):
    it = self.ftp
    it.cwd(ftpDir)
    os.chdir(localDir)
    returnFileName=[]
    for filename in it.nlst(filematch):
      fhandle = open(filename,'wb')
      returnFileName.append(filename)
      it.retrbinary('RETR ' + filename, fhandle.write)
      fhandle.close()
    return returnFileName

  def ftpMove(self,source,destination,filematch='*'):
    it = self.ftp
    now = datetime.datetime.now()
    filetime = now.strftime("%Y%m%d%H%M%S")
    it.cwd(source)
    for file in it.nlst(filematch):
      it.rename(source+file,destination+file+'_'+str(filetime))
    return "File Moved"

  def ftpPut(self,localDir,ftpDir,filename):
    it = self.ftp
    it.cwd(ftpDir)
    returnFileName=[]
    with open(localDir+filename,'rb') as fhandle:
      it.storbinary('STOR ' + filename, fhandle)
      returnFileName.append(filename)
    return returnFileName
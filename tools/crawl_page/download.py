#!/bin/env
# -*- coding: utf-8 -*-
import os
import socket
import urllib2


# try:
#     response = urllib2.urlopen("http://www.fuzokuu.com/12")
#     print response.read()
#
# except urllib2.HTTPError, e:
#     print e.code
#
# except urllib2.URLError, e:
#     print e.reason
# else:
#     print 12

for index in range(1019, 1020):
    try:
        response = urllib2.urlopen("http://www.fuzokuu.com/"+str(index), None, 3)
        path = os.path.join(r"test", str(index)+".txt")
        fo = open(path, "w")
        s = response.read()
        fo.write(s)
        fo.close()
        # print response.read()
    except urllib2.HTTPError, e:
        print "编号"+str(index)+"错误："+str(e.code)
        continue
    except urllib2.URLError, e:
        print "编号"+str(index)+"错误："+str(e)
        continue
    except socket.timeout, e:
        print e
    else:
        print index
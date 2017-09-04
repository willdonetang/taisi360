#!/bin/env
# -*- coding: utf-8 -*-
import MySQLdb


def connect_gogobar_db():
    conn = None
    try:
        conn = MySQLdb.connect(host='localhost', user='root', passwd='', port=3306, charset="utf8")
        cur = conn.cursor()
        conn.select_db('gogobar')
    except MySQLdb.Error, e:
        print "Mysql Error %d: %s" % (e.args[0], e.args[1])
    return conn




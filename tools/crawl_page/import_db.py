#!/bin/env
# -*- coding: utf-8 -*-
import MySQLdb
import json
import time
import traceback


def connect_db():
    try:
        conn = MySQLdb.connect(host='localhost', user='root', passwd='', port=3306, charset="utf8")
        cur = conn.cursor()
        conn.select_db('gogobar')
    except MySQLdb.Error, e:
        print "Mysql Error %d: %s" % (e.args[0], e.args[1])
    return conn


def category_db(conn, category):
    id = 0
    cur = conn.cursor()
    sql = "SELECT * FROM `easy_category` WHERE  `name` = '%s' " % category
    print sql
    count = cur.execute(sql)
    # print 'there has %s rows record' % count
    if count > 0:
        data = cur.fetchone()
        id = data[0]
        print "select category id = %d" % (id)
    else:
        sql = "INSERT INTO `easy_category` (`name`,`isshow`,`isverify`,`ispush`) VALUES(%s,%s,%s,%s)"
        count = cur.execute(sql, (category, 0, 1, 0))
        id = int(cur.lastrowid)
        print 'insert into %s rows record,id=%d' % (count, id)
    cur.close()
    return id


def insert_article(conn, ob):
    select_sql = "SELECT * FROM `easy_article` WHERE  `src_id` = '%s'" % ob['id']
    sql = 'insert into easy_article (tid,title,keyword,pubtime,summary,content,approval,opposition,iscommend,ispush,isslides,islock,src_id) values(%s,%s,%s,%s,%s,%s,%s,%s,%s,%s,%s,%s,%s)'

    cur = conn.cursor()
    res = cur.execute(select_sql)
    if res > 0:
        print "id是:", ob['id']
        return
    else:
        pubtime = int(time.time())
        count = cur.execute(sql, (
        ob['tid'], ob['title'], ob['keyword'], pubtime, ob['summary'], ob['content'], 0, 0, 1, 1, 0, 0, ob['id']))
        if count > 0:
            print 'insert id=%s,"%s" ok' % (ob['id'], ob['title'])
        else:
            print 'insert id=%s,"%s" failed' % (ob['id'], ob['title'])
    cur.close()


db_conn = connect_db()
path = "fix_img.txt"
for line in open(path):
    line = line.strip()
    if not line:
        continue
    try:
        ob = json.loads(line)
        print ob['id'], ob['category']
        id = category_db(db_conn, ob['category'].encode('utf-8'))
        ob['tid'] = id
        insert_article(db_conn, ob)
    except Exception, e:
        print "error:%s" % e
        traceback.print_exc()
db_conn.close()

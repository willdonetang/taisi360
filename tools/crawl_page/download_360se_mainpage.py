#!/bin/env
# -*- coding: utf-8 -*-
import urllib

from snownlp import SnowNLP

from langconv import *
import sys
import os
import socket
import urllib2

import datetime
import time
from bs4 import BeautifulSoup
from db import *


def get_url_list(url):
    article = []
    url_list = []
    try:
        response = urllib2.urlopen(url, None, 3)
        s = response.read()
        soup = BeautifulSoup(s)
        article = soup.find_all("a", class_="more-link")
    except urllib2.HTTPError, e:
        print "error：" + str(e.code)
    except urllib2.URLError, e:
        print "error：" + str(e)
    except socket.timeout, e:
        print e
    for index in range(0, len(article)):
        url_list.append(article[index]['href'])
    return url_list


def download(url):
    s = None
    try:
        response = urllib2.urlopen(url, None, 3)
        url_id = int(url.split("/")[-1])
        path = os.path.join(r"pages", str(url_id))
        fo = open(path, "w")
        s = response.read()
        fo.write(s)
        fo.close()
        # print response.read()
    except urllib2.HTTPError, e:
        print "HTTPError:" + str(e.code)
    except urllib2.URLError, e:
        print "错误：" + str(e)
    except socket.timeout, e:
        print e
    return s


# 输入Unicode编辑,输出Unicode
def big2simple(line):
    # 转换繁体到简体
    line = Converter('zh-hans').convert(line)
    return line


def get_summary(content):
    soup = BeautifulSoup(content)
    text = soup.get_text()
    s = SnowNLP(text)
    summary = s.summary(10)
    # print keywords, summary
    return summary


def get_category_tid(db, category_list):
    id = 0
    category = None
    cur = db.cursor()
    try:
        for index in range(0, len(category_list)):
            # 查询字段isshow = 1
            sql = "SELECT * FROM `easy_category` WHERE  `name` = '%s'  AND `isshow` = 1 " % category_list[index]
            count = cur.execute(sql)
            if count > 0:
                data = cur.fetchone()
                id = data[0]
                category = category_list[index]
                print "select category id = %d" % (id)
                break
        if id == 0:
            # 如果包含基础知识或者基本知识,需要改为id = 80 的 category为“泰国旅游攻略”
            if category_list.count("基础知识") or category_list.count("基本知识"):
                id = 80
                category = "泰国旅游攻略"
            else:
                id = 81
                category = "其他"
    except MySQLdb.Error, e:
        print "Mysql Error %d: %s" % (e.args[0], e.args[1])
    return id, category


def insert_db(result, db):
    try:
        sql = 'insert into easy_article (tid,title,keyword,pubtime,summary,content,approval,opposition,iscommend,ispush,isslides,islock,src_id) values(%s,%s,%s,%s,%s,%s,%s,%s,%s,%s,%s,%s,%s)'

        cur = db.cursor()
        pubtime = int(time.time())
        count = cur.execute(sql, (
            result['tid'], result['title'], result['keyword'], pubtime, result['summary'], result['content'], 0, 0, 1,
            1, 0, 0, result['id']))
        if count > 0:
            print 'insert id=%s,"%s" ok' % (result['id'], result['title'])
        else:
            print 'insert id=%s,"%s" failed' % (result['id'], result['title'])
        cur.close()
    except MySQLdb.Error, e:
        print "Mysql Error %d: %s" % (e.args[0], e.args[1])


def download_img(img_url, year, month, id, num):
    dir_path = "images/%s/%s/" % (year, month)
    if not os.path.exists(dir_path):
        os.makedirs(dir_path)
    path = os.path.join(dir_path, "%s_%s.jpg") % (id, num)
    img_url_dic[img_url] = path
    data = urllib.urlopen(img_url.encode("utf-8")).read()
    f = file(path, "wb")
    f.write(data)
    f.close()


def save_img_url(img_url, id, year, month, num):
    # dir = "./Uploads/Article/crawl_images"
    # year_path =
    # month_path = os.path.join(year_path, "/", month)

    download_img(img_url, year, month, id, num)


def get_category(soup, db):
    category = None
    tid = 0
    node = soup.find_all("a", attrs={"rel": "category"})
    if node:
        print node
        category_list = []
        for category_node in node:
            print category_node
            category_list.append(big2simple(category_node.get_text()))
        # result['category'] = big2simple(node[-1].get_text())
        tid, category = get_category_tid(db, category_list)
    return tid, category


def fix_content(html_content):
    # 修正图片url
    for img_dic in img_url_dic:
        dirpath = "./Uploads/Article/crawl_images"
        fixed_url = os.path.join(dirpath, img_url_dic[img_dic])
        html_content = html_content.replace(big2simple(img_dic), fixed_url)
    # 去掉相关文章
    soup = BeautifulSoup(html_content)
    soup.find("h3",text="和本篇文章主题相关的文章：").decompose()
    soup.find("div",class_="yarpp-thumbnails-horizontal").decompose()

    html_content = str(soup).encode("utf-8")
    return html_content


def get_content(soup, id):
    content = None
    node = soup.find("div", class_="entry-content")
    if node:
        html_content = get_html_content(node)
        save_content_img(id, node)
        # 修正正文中img_url的列表
        content = fix_content(html_content)
    return content


def save_content_img(id, node):
    html_img_list = node.find_all("img")
    img_list = []
    img_count = 0
    for img in html_img_list:
        img_url = img['src']
        img_list.append(img_url)
        img_count = img_count + 1
        save_img_url(img_url, id, year, month, img_count)


def get_html_content(node):
    for i in node.find_all("script"):
        i.decompose()
    for i in node.find_all("iframe"):
        i.decompose()
    tmp = node.find("a", class_="twitter-share-button")
    if tmp:
        tmp.decompose()
    return big2simple(unicode(node))


def insert_article_db(soup, db, id, year, month):
    cur = db.cursor()
    result = {}

    result['id'] = id
    # keyword
    result['keyword'] = get_keyword(soup)
    # print result['keyword']

    # title
    result['title'] = get_title(soup)

    # category,tid
    result['tid'], result['category'] = get_category(soup, db)

    # 正文
    result['content'] = get_content(soup, id)
    result['summary'] = ",".join(get_summary(result['content']))
    insert_db(result, db)
    cur.close()


def get_title(soup):
    title = None
    node = soup.find("h1", attrs={"class": "entry-title"})
    if node:
        title = big2simple(node.get_text())
    return title


def get_keyword(soup):
    keyword = None
    node = soup.find_all("meta", attrs={"property": "article:tag"})
    key = ""
    if node:
        for no in node:
            key = key + no['content'] + ","
        keyword = big2simple(key)
    return keyword


def insert_url_list(url_list, year, month):
    try:
        con = connect_gogobar_db()
        cur = con.cursor()
        for url in url_list:
            url_id = int(url.split("/")[-1])
            sql = "SELECT * FROM `easy_article` WHERE  `src_id` = %d " % url_id
            print sql
            count = cur.execute(sql)

            if count > 0:
                print count
            else:
                html = download(url)
                if html:
                    soup = BeautifulSoup(html)
                    insert_article_db(soup, con, url_id, year, month)
        con.close()
    except MySQLdb.Error, e:
        print "Mysql Error %d: %s" % (e.args[0], e.args[1])


reload(sys)
sys.setdefaultencoding('utf-8')
img_url_dic = {}
if __name__ == "__main__":
    month = None
    year = None
    if len(sys.argv) != 3 and len(sys.argv) != 1:
        print "parameter error :python download_360se_mainpage.py 2017 6 or python download_360se_mainpage.py"
    else:
        if len(sys.argv) == 1:
            now_time = datetime.datetime.now()
            month = now_time.strftime('%m')
            year = now_time.strftime('%Y')
        if len(sys.argv) == 3:
            if int(sys.argv[1]) < 2000 or int(sys.argv[2]) > 12 or int(sys.argv[2]) < 0:
                print "year or month error!"
            else:
                year = sys.argv[1]
                month = sys.argv[2]
    if month and year:
        print month, year
        mainUrl = "http://www.fuzokuu.com"
        baseUrl = mainUrl + "/date/%s/%s" % (year, month)
        newUrlList = get_url_list(baseUrl)
        insert_url_list(newUrlList, year, month)

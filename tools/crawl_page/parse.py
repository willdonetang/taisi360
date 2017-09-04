#!/bin/env
# -*- coding: utf-8 -*-

from langconv import *
from bs4 import BeautifulSoup
import re
import os
import json


# 输入Unicode编辑,输出Unicode
def big2simple(line):
    # 转换繁体到简体
    line = Converter('zh-hans').convert(line)
    return line


def save_img_url(img_url, num):
    img_url_file = open("img_url.txt", "a")
    line = num + "\t" + img_url + "\n"
    img_url_file.write(line.encode("utf-8"))
    img_url_file.close()


# path文件路径，num是代表源文件编号
def parse_html(path, num):
    in_file = open(path, "r")
    if not in_file:
        print path, "open error"
        return None
    soup = BeautifulSoup(open(path, "r"))
    result = {}
    result['id'] = num
    # keyword
    keyword = None
    node = soup.find_all("meta", attrs={"property": "article:tag"})
    key = ""
    if node:
        for no in node:
            key = key + no['content']+","
        result['keyword'] = big2simple(key)
        print result['keyword']
    # title
    title = None
    node = soup.find("h1", attrs={"class": "entry-title"})
    if node:
        result['title'] = big2simple(node.get_text())

    # category
    category = None
    node = soup.find_all("a", attrs={"rel": "category"})
    if node:
        print node
        result['category'] = big2simple(node[-1].get_text())
        # node = node.find('a')
        # if node:

    # 正文
    content = None
    node = soup.find("div", class_="entry-content")
    if node:
        for i in node.find_all("script"):
            i.decompose()
        for i in node.find_all("iframe"):
            i.decompose()
        tmp = node.find("a", class_="twitter-share-button")
        if tmp:
            tmp.decompose()
        content = big2simple(unicode(node))
        result['content'] = content

        # 正文图片
        img_list = node.find_all("img")
        result['img_list'] = []
        for img in img_list:
            img_url = img['src']
            result['img_list'].append(img_url)
            # save_img_url(img_url, num)

    return result


def save_result(file_path, ret):
    file_out = open(file_path, "a")
    ret = json.dumps(ret)
    file_out.write(ret)
    file_out.write("\n")
    file_out.close()


def load_files_list(path):
    file_list = []
    for i in open(path):
        line = i.strip()
        if not line:
            continue
        file_list.append(line)
    print "load_files_list ok, count=%d" % len(file_list)
    return file_list


if __name__ == "__main__":
    dir_path = r'pages'
    file_num_list = load_files_list("files.txt")
    for file_num in file_num_list:
        path = os.path.join(dir_path, file_num)
        print path
        ret = parse_html(path, file_num)
        save_result("ret.txt", ret)

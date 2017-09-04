#!/bin/env
# -*- coding: utf-8 -*-
import httplib
import urllib
import os


def download_img(url, path):
    data = urllib.urlopen(url).read()
    f = file(path, "wb")
    f.write(data)
    f.close()


def save_record(url, path):
    out_file = open("img_record.txt", "a")
    out_file.write("%s\t%s\n" % (url, path))
    out_file.close()


img_url = "img_url.txt"
dir = "images"
cur_num = 0
count = 1
for line in open(img_url):
    line = line.strip()
    if not line:
        continue
    num, url = line.split("\t")
    num = int(num)
    print num, url
    if cur_num == num:
        count = count + 1
    else:
        count = 1
        cur_num = num
    name = "%d_%d.jpg" % (cur_num, count)
    path = os.path.join(dir, name)
    print path
    download_img(url, path)
    save_record(url, path)

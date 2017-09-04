#!/bin/env
# -*- coding: utf-8 -*-
import re
import os
import json
from snownlp import SnowNLP
from bs4 import BeautifulSoup


def save_new_json(str):
    out_file = open("ret_summary.txt", 'a')
    out_file.write(str)
    out_file.write("\n")
    out_file.close()


def get_summary(content):
    soup = BeautifulSoup(content)
    text = soup.get_text()
    s = SnowNLP(text)
    keywords = s.keywords(10)
    summary = s.summary(10)
    # print keywords, summary
    return keywords, summary


def test_summary(keywords, summary):
    print "keyword"
    for k in keywords:
        print k,
    print "\nsummary"
    for s in summary:
        print s,


def save_summary(path, str):
    out_file = open(path, 'a')
    out_file.write(str.encode("utf-8"))
    out_file.write("\n")
    out_file.close()


def read_data(line):
    ob = json.loads(line)
    if 'category' not in ob:
        print "no category"
        return
    # id，keyword,title,content,category
    print ob['id'], ob['category']
    # content = ob['content']
    keywords, summary = get_summary(ob['content'])
    ob['summary'] = ",".join(summary)
    #save_summary("summary.txt","%s\t%s" % (ob['id'],ob['summary']))
    save_new_json(json.dumps(ob))


# test_summary(keywords,summary)
# print ob['content']


if __name__ == "__main__":
    file_path = "ret.txt"
    for line in open(file_path):
        line = line.strip()
        if not line and len(line) == 0:
            continue
        read_data(line)

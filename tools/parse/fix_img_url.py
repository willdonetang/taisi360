#!/bin/env
# -*- coding: utf-8 -*-
import re
import os
import json
from langconv import *
#输入Unicode编辑,输出Unicode
def big2simple(line):
	#转换繁体到简体
	line = Converter('zh-hans').convert(line)
	return line
	
	
urm_name_map = None
def load_url(path):
	ret = {}
	dir = "./Uploads/Article/crawl_images"
	for line in open(path):
		line = line.strip()
		if not line:
			continue
		url,name = line.split("\t")
		url = big2simple(url.decode('utf-8'))
		name = os.path.basename(name)
		path = "%s/%s" % (dir,name)
		ret[url] = path
		#print url,path
	return ret

def replace_img_url(content):
	for url in urm_name_map:
		#print url,urm_name_map[url]
		content = content.replace(url,urm_name_map[url])
	return content
	
def save_new_json(str):
	out_file = open("fix_img.txt",'a')
	out_file.write(str)
	out_file.write("\n")
	out_file.close()
	
def read_data(line):
	ob = json.loads(line)
	#id，keyword,title,content,category
	print ob['id'],ob['category']
	content = ob['content']
	ob['content'] = replace_img_url(content)
	#print ob['content']
	save_new_json(json.dumps(ob))
	
	
if __name__=="__main__":
	urm_name_map = load_url("img_record.txt")
	file_path = "ret_summary.txt"
	for line in open(file_path):
		line = line.strip()
		if not line and len(line)==0:
			continue
		read_data(line)
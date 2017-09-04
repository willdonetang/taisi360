# -*- coding: utf-8 -*-  
import Image  
import sys  
import os.path  
from  datetime  import  *    
import random  
import time  

def crop_img(img_path):
	ext_name = os.path.splitext(img_path)
	base_name = os.path.basename(img_path)
	im=Image.open(img_path)
	
	width = im.size[0]
	height = im.size[1]
	print width,height
	if width<100 or height<100:
		return	
	box = (0,0,width,height-16)
	new_img = im.crop(box)
	new_img.save(img_path)

if __name__=="__main__":
	rootdir = r"images"
	for i in os.listdir(rootdir):
		img_path = os.path.join(rootdir,i)
		if os.path.isfile(img_path):
			print img_path
			crop_img(img_path)

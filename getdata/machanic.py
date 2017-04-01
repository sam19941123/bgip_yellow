# -*- coding: utf8 -*-
import urllib2
import re
import MySQLdb
import jianfan
from bs4 import BeautifulSoup

# 設定counter
db = MySQLdb.connect('127.0.0.1','root','kuanting','BGbot',charset='utf8', init_command='SET NAMES UTF8')

# 目前擷取：Boardgamegeek Category
url = 'https://boardgamegeek.com/browse/boardgamemechanic'
response = urllib2.urlopen(url)
html = response.read()
soup = BeautifulSoup(''.join(html),"html.parser")

hrefs = soup.find('table',{'class':'forum_table'}).find_all('a')

for href in hrefs:

    cate_id = href['href'].split('/')
    cate_id = cate_id[2]

    name = href.string

    cursor = db.cursor()
    sql = """INSERT INTO mechanics(id,name_english) VALUES("%d","%s")""" % (int(cate_id),name)
    cursor.execute(sql)
    db.commit()




db.close()
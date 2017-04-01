# -*- coding: utf8 -*-
import urllib2
import re
import MySQLdb
import jianfan
from bs4 import BeautifulSoup

# 設定counter
counter = int(raw_input("請輸入要從bggid幾號開始抓取資料："))
db = MySQLdb.connect('127.0.0.1','root','kuanting','BGbot',charset='utf8', init_command='SET NAMES UTF8')

# 目前擷取：Boardgamegeek
while 1:
    url = 'https://www.boardgamegeek.com/xmlapi/boardgame/' + str(counter)+ '?&stats=1'
    response = urllib2.urlopen(url)
    html = response.read()
    soup = BeautifulSoup(''.join(html),"xml")

    # 如果item 沒找到
    if( soup.find('error') != None ):
        if( soup.find('error')['message'] == 'Item not found' ):
            print 'Item not found'
            counter = counter+1
            continue

    # 如果找到配件
    if( soup.find('rank')['name'] == 'boardgameaccessory' ):
        print 'Help! We found an accessory!'
        counter = counter+1
        continue

    name_eng = soup.find('name',{'primary':'true'}).string
    name_cht_possible = soup.find_all('name')
    
    # 找中文名字
    find = 0
    for name in name_cht_possible:
        name = name.string

        for character in name:
            if( u'\u4e00' <= character <= u'\u9fff'):
                find = 1
                break

        if find == 1:
            for character in name:
                if( u'\u3041' <= character <= u'\u309C' or u'\uAC00' <= character <= u'\uCB4C' ):
                    find = 0
                    break

            name = name.encode('utf8')
            name_cht = jianfan.jtof(name)

        if find == 0:
            name_cht = 'No cht name'
                
    player_min = soup.find('minplayers').string
    player_max = soup.find('maxplayers').string
    game_time = soup.find('maxplaytime').string
    publish_year = soup.find('yearpublished').string

    if soup.find('image') != None:
        imgsrc = soup.find('image').string
        imgsrc = imgsrc.split('/')[4]
    else:
        imgsrc = 0

    total_rank = soup.find('rank',{'name':'boardgame'})
    if total_rank != None:
        if total_rank['value'] == 'Not Ranked':
            total_rank = 0
        else:
            total_rank = total_rank['value']
    else:
        total_rank = 0


    cata = soup.find_all('rank',{'name': lambda x: x!= 'boardgame'})
    if len(cata) == 0:
        cata2_name = ""
        cata2_rank = 0
    if len(cata) > 0:
        cata2_name = cata[0]['friendlyname']
        cata2_rank = cata[0]['value']
        if cata2_rank == 'Not Ranked':
            cata2_rank = 0
    if len(cata) > 1:
        cata3_name = cata[1]['friendlyname']
        cata3_rank = cata[1]['value']
        if cata3_rank == 'Not Ranked':
            cata3_rank = 0
        
    if len(cata) > 2:
        print 'i have more than two catas'
        print len(cata)

    cata3_name = ""
    cata3_rank = 0

    cht_version = 0

    versions = soup.find_all('boardgameversion')
    for version in versions:
        if 'Chinese' in version.string:
            cht_version = 1
            break
        else:
            cht_version = 0
    
    age = soup.find('age').string
    gameweight = soup.find('averageweight').string

    lang_poll = soup.find('poll',{'name':'language_dependence'}).find_all('result')
    language_dependence = 0
    poll_max = 0
    for result in lang_poll:
        if(result['numvotes'] > poll_max):
            poll_max = result['numvotes']
            language_dependence = result['level']

    designers = soup.find_all('boardgamedesigner')
    
    for designer in designers:
        designer_name = MySQLdb.escape_string(designer.string.encode('utf8'))
        cursor = db.cursor()
        sql = """INSERT INTO games_designer(bgg_id,game_designer) VALUES("%d","%s")""" % (counter,designer_name)
        cursor.execute(sql)
        db.commit()

    mechanics = soup.find_all('boardgamemechanic')
    if mechanics != None:
        for mechanic in mechanics:
            cursor = db.cursor()
            sql = """INSERT INTO game_mechanic(bgg_id,mechanic_id) VALUES("%d","%s")""" % (counter,mechanic['objectid'])
            cursor.execute(sql)
            db.commit()

    categories = soup.find_all('boardgamecategory')
    if categories != None:
        for category in categories:
            cursor = db.cursor()
            sql = """INSERT INTO game_category(bgg_id,category_id) VALUES("%d","%s")""" % (counter,category['objectid'])
            cursor.execute(sql)
            db.commit()


    cursor = db.cursor()
    sql = """INSERT INTO games(text_dependency,age,game_weight,name_english,name_chinese,bggid,player_min,player_max, \
            publish_year,game_time,catalog1_rank,catalog2,catalog2_rank,catalog3,catalog3_rank,imgsrc,cht_version) \
            VALUES ("%d","%d","%f","%s","%s","%d","%d","%d","%d","%d","%d","%s","%d","%s","%d","%s","%d")""" % \
            (int(language_dependence),int(age),float(gameweight),name_eng,name_cht,counter,int(player_min),int(player_max),int(publish_year),int(game_time),int(total_rank),cata2_name,int(cata2_rank),cata3_name,int(cata3_rank),imgsrc,cht_version)
            
    cursor.execute(sql)
    print '%d Insert Completed : %s , %s' % (counter,name_eng,name_cht)
    db.commit()

    counter = counter + 1


db.close()
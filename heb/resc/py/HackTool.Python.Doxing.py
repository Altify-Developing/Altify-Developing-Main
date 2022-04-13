import os
import requests
import sys
import subprocess
import re
import face_recognition
import json

done_checks = []
social_media = []
usernames = []
emails = []
twitter = []
instagram = []
steam = []
urls = []
urls_stalk = []
urls_done = []
name = ""
adresse = ""
compare = False
first_dl = False

def stalk(user):
    if len(user) > 1:
        global urls_stalk
        pastebin_url = "https://pastebin.com/u/" + user
        pastebin_str = "s Pastebin - Pastebin.com"
        patreon_url = "https://www.patreon.com/" + user
        patreon_str = 'created_at'
        gutefrage_url = "https://www.gutefrage.net/nutzer/" + user
        gutefrage_str = '<meta name="title" content="Profil von'
        ebay_url = "https://www.ebay.de/usr/" + user
        ebay_str = '<span>Angemeldet seit: </span>'
        twitter_url = "https://twitter.com/" + user
        twitter_str = '<link rel="canonical" href="https://twitter.com/' + user + '">'
        facebook_url = 'https://facebook.com/' + user
        facebook_str = ' hreflang="sv" href="https://sv-se.facebook.com/' + user
        instagram_url = "https://www.instagram.com/" + user + "/"
        instagram_str = '<link rel="alternate" href="https://www.instagram.com/' + user + '/?hl=en" hreflang="en" />'
        steam_url = "https://steamcommunity.com/id/" + user
        steam_str = 'https://steamcommunity-a.akamaihd.net/public/images/skin_1/arrowDn9x5.gif'
        twitch_url = "https://www.twitch.tv/" + user
        twitch_str = "content='twitch://stream/" + user
        lachschon_url = "https://www.lachschon.de/community/user/" + user + "/"
        lachschon_str = '<label>Rang</label>'

        URLS = [pastebin_url, patreon_url, gutefrage_url, ebay_url, facebook_url, twitter_url, instagram_url, steam_url, twitch_url, lachschon_url]
        STRS = [pastebin_str, patreon_str, gutefrage_str, ebay_str, facebook_str, twitter_str, instagram_str, steam_str, twitch_str, lachschon_str]

        for i in range(0, len(URLS)):
            html = getResponse(URLS[i])
            if STRS[i].lower() in str(html).lower():
                print("\t> " + URLS[i])
                urls_stalk.append(URLS[i])

def get_twitter_img(user):
    url = "https://twitter.com/" + user
    html = subprocess.getoutput("phantomjs html.js " + url)
    image = find_between(html, '<img class="ProfileAvatar-image " src="', '" alt="')
    r = requests.get(image)
    with open('Twitter.jpg', 'wb') as f:
        f.write(r.content)

def get_instagram_img(user):
    data = {
    'username': user,
    'submit': 'View DP'
    }
    response = requests.post('https://fullinstadp.com/index.php', data=data)
    html = response.text
    f = open("Out.html", "w")
    f.write(html)
    f.close
    img_url = find_between(html, '<img class="loading img-rounded center-block img-responsive" src="', '" alt=""')
    r = requests.get(img_url)
    with open('Instagram.jpg', 'wb') as f:
        f.write(r.content)

def check_mail(string):
    EMAIL_REGEX = re.compile(r"[^@]+@[^@]+\.[^@]+")
    if EMAIL_REGEX.match(string):
        return True
    else:
        return False

def check_string_mail(string):
    global emails
    splitted = string.split(" ")
    for word in splitted:
        if check_mail(word):
            emails.append(word)

def check_string_url(string):
    global urls
    for word in string.split(" "):
        try:
            url = re.search("(?P<url>https?://[^\s]+)", word).group("url")
            if '//t.co/' in url:
                last = url[-1:]
                if last == ".":
                    url = url.rstrip('.')
                r = requests.get(url)
                url = r.url
            urls.append(url)
        except:
            e = ""

def check_string_socialmedia(string):
    global social_media
    count = 0
    next = 0
    for word in string.split(" "):
        next = count + 2
        if 'facebook' in word.lower():
            print(string.split(" ")[next])
        count +=1

def youtube(url):
    url = url + "/about"
    html = subprocess.getoutput("phantomjs html.js " + url)
    tmp_str = html.split('"}},"urlEndpoint":')
    for url in tmp_str:
        #print(url)
        url = find_between(url, '{"url":"', '","target":')
        print(html)

def grab_instagram(profile):
    global done_checks
    global urls
    global instagram
    global usernames
    global compare
    if not "instagram: " + profile in done_checks:
        if not profile in usernames:
            usernames.append(profile)
        url = "https://www.instagram.com/" + profile + "/"
        html = subprocess.getoutput("phantomjs html.js " + url)
        if '"@type":"Person","name":"' in html:
            display_name = find_between(html, '"@type":"Person","name":"', '","alternateName":"')
            if not display_name in usernames:
                usernames.append(display_name)
            if not "instagram: " + display_name in done_checks:
                print(display_name)
                stalk(display_name)
            instagram.append("Display Name: " + display_name)
        description = find_between(html, '"user":{"biography":"', '","blocked_by_viewer')
        follower = find_between(html, 'edge_followed_by":{"count":', '},"followed_by_viewer')
        check_string_mail(description)
        check_string_url(description)
        instagram.append("Description: " + description)
        instagram.append("Follower: " + follower)
        #get_instagram_img(profile) // Buggy suche nach Alternative zu siehe Funktion
        compare = True
        if not "instagram: " + profile in done_checks:
            done_checks.append("instagram: " + profile)
   
def grab_steam(url):
    global done_checks
    global urls
    global usernames
    if not "steam: " + profile in done_checks:
        url = url + "/ajaxaliases/"
        response = requests.get(url)
        html = response.text
        for item in html.split("newname"):
            username = find_between(item, '":"', '","timechanged')
            if not username in usernames:
                usernames.append(username)



def grab_twitter(profile):
    global done_checks
    global urls
    global adresse
    global usernames
    global twitter
    global first_dl
    if not "twitter: " + profile in done_checks:
        url = "https://twitter.com/" + profile
        urls.append(url)
        html = subprocess.getoutput("phantomjs html.js " + url)
        #variables
        display_name = find_between(html, '<title>', ' (@')
        if not profile in usernames:
            usernames.append(profile)
        if not display_name in usernames:
            usernames.append(display_name)
        if not "twitter: " + display_name in done_checks:
            print(display_name)
            stalk(display_name)
        join_date = find_between(html, 'ProfileHeaderCard-joinDateText js-tooltip u-dir" dir="ltr" title="', '">Beigetreten')
        description = ""
        url = ""
        location = ""
        #if
        if '<meta name="description"' in html:
            description = find_between(html, '<meta name="description" content="', '">')
            description = description.replace("&quot", "")
            check_string_mail(description)
            check_string_url(description)
        if '<span class="ProfileHeaderCard-urlText u-dir">  <a class="u-textUserColor"' in html:
            tmp = find_between(html, '<span class="ProfileHeaderCard-urlText u-dir">', '</a>')
            url = find_between(tmp, '" title="', '">')
            urls.append(url)
        if 'location&quot;:&quot;' in html:
            location = find_between(html, '&quot;location&quot;:&quot;', '&quot;,&quot;url')
            if len(location) > 0:
                adresse = location
        twitter.append("Display Name: " + display_name)
        twitter.append("Join Date: " + join_date)
        twitter.append("Description: " + description)
        twitter.append("URL: " + url)
        twitter.append("Location: " + location)
        twitter.append("                    ")
        #if first_dl == False:
            #get_twitter_img(profile)
            #first_dl = True
        if not "twitter: " + profile in done_checks:
            done_checks.append("twitter: " + profile)



def handle():
    try:
        if sys.argv[1]:
            social_media = sys.argv[1].lower()
        if sys.argv[2]:
            info_type = sys.argv[2].lower()
        if sys.argv[3]:
            infos = sys.argv[3].lower()
        if info_type == "url":
            if social_media == "youtube":
                youtube(infos)
        elif info_type == "profile":
            if social_media == "twitter":
                grab_twitter(infos)
        elif info_type == "user":
            if social_media == "stalk":
                stalk(infos)
    except Exception as e:
        print(e)

def find_between( s, first, last ):
    try:
        start = s.index( first ) + len( first )
        end = s.index( last, start )
        return s[start:end]
    except ValueError:
        return ""

def getResponse(url):
    response = requests.get(url)
    #response.raise_for_status()
    data = response.content
    return data



handle()

for url in urls_stalk:
    #print(url)
    if 'twitter.com' in url:
        checked = False
        profile = url.split("/")[3]
        for check in done_checks:
            if check == "twitter: " + profile:
                checked = True
        if not checked:
            grab_twitter(profile)
            done_checks.append("twitter:" + profile)
           
    if 'instagram.com' in url:
        checked = False
        profile = url.split("/")[3]
        for check in done_checks:
            if check == "instagram: " + profile:
                checked = True
        if not checked:
            grab_instagram(profile)
            #print("Download Profile Picture")
            done_checks.append("instagram: " + profile)
    #Steam Check direkt in der Stalk Funktion
    if 'steamcommunity.com' in url:
        checked = False
        profile = url.split("/")[4]
        for check in done_checks:
            if check == "steam: " + profile:
                checked = True
        if not checked:
            grab_steam(url)
            done_checks.append("steam: " + profile)
           

print("------------------")
print("Usernames:")
print("------------------")
for user in usernames:
    print(user)
    stalk(user)

if len(urls) > 0:
    print("------------------")
    print("URLs:")
    print("------------------")
    for url in urls:
        print(url)

if len(twitter) > 0:
    print("------------------")
    print("Twitter:")
    print("------------------")
    for item in twitter:
        print(item)

if len(instagram) > 0:
    print("------------------")
    print("Instagram:")
    print("------------------")
    for item in instagram:
        print(item)

if len(steam) > 0:
    print("------------------")
    print("Steam:")
    print("------------------")
    for item in steam:
        print(item)

print("------------------")
print("Sites checked:")
print("------------------")
for check in done_checks:
    print(check)

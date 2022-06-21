import requests
from bs4 import BeautifulSoup
from bs4.formatter import HTMLFormatter
import re
import os
from alive_progress import alive_bar


# vgm_url = 'https://mp.weixin.qq.com/s?__biz=MzU5MTgxMjYzNg==&amp;mid=2247501678&amp;idx=1&amp;sn=bbf369c94b7bd23c622744de63bd5299&amp;chksm=fe2bc61dc95c4f0b8a9c8c4246f932a4450f389369848170a6b4f29f6d85bbead2a5f73ba06f&token=2059393238&lang=zh_CN#rd'
vgm_url = input("Input the original URL(start with https): ")
html_text = requests.get(vgm_url).text
soup = BeautifulSoup(html_text, 'html.parser')
# find title of the article
title = soup.find('h1').get_text().strip()
# make folder and for images
while(1):
    en_title = input("Input English version of the title, no space: ")
    files = set(os.listdir())
    l = len(files)
    files.add(en_title + ".html")
    if len(en_title.split()) == 1:
        if len(files) == l:
            print("Duplicated Name")
        else:
            break
    else:
        print("Invalid Name")
# find the body of the article
dat = soup.find("section")
# find image tags
img = dat.select("div img")


# download and create directory for images
# no matter whether the directory exists, the images will always be downloaded
def download_imgs():
    # no matter whether the directory exists, the images will always be downloaded
    img_name_values = []
    try:
        os.mkdir("img")
    except FileExistsError:
        pass
    finally:
        os.chdir("img")
        try:
            os.mkdir(en_title)
        except FileExistsError:
            pass
        finally:
            os.chdir("..")
            with alive_bar(len(img)) as bar:
                for i in range(len(img)):
                    img_data = requests.get(img[i]["data-src"]).content
                    img_name = "img/" + en_title + "/" + en_title + "_" + "img_" + str(i) + "." + img[i]["data-type"]
                    img_name_values.append(img_name)
                    with open(img_name, 'wb') as handler:
                        handler.write(img_data)
                        bar()
        return img_name_values


# change image src in html code
img_name_values = download_imgs()
for i in range(len(img)):
    del img[i]['data-src']
    img[i]['src'] = img_name_values[i]

# find author
all_p = dat.find_all('p')
author = None
for i in range(len(all_p)):
    try:
        if "文字" in all_p[i].string or "作者" in all_p[i].string:
            break
    except:
        pass
try:
    author = re.sub(r"[,.;@#?!&$]+\ *", "", all_p[i + 1].text).strip()
except IndexError:
    author = input("Input author name: ")
# combine body with madnew head and tail html code
with open(r'head.html', "r") as f:
    page = f.read()
head = BeautifulSoup(page, 'html.parser')
# change title, author and time of the head
for each in head.find_all('title'):
    each.string = title
for each in head.find_all('h2'):
    each.string = title
head.find_all('a')[-1].string = input("Input the category of the article: ")
head.find_all('p')[0].string = input("Input the time when the article is created(eg: March 9, 2022): ")
head.find_all('p')[1].string = "作者：" + author
# due to beautifulsoup package, the html code is complete. since we must add body into incomplete code
# add loss string into tail and delete it from head
loss_string = "</div>\n                </div>\n            </div>\n        </section>\n    </body>\n</html>"
with open(r'tail.html', "r") as f:
    page = f.read()
tail = BeautifulSoup(page, 'html.parser')
# format the html code and write out
formatter = HTMLFormatter(indent=4)
temp_head = re.sub(loss_string, "", head.prettify(formatter=formatter))
temp_tail = loss_string + tail.prettify(formatter=formatter)
write_page = temp_head + dat.prettify(formatter=formatter) + temp_tail
output_title = en_title + ".html"
with open(output_title, "w") as file:
    file.write(write_page)

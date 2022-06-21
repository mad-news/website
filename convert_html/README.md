# README

## Included Files

- convert_html.py
- head.html
- tail.html

They must be in the same directory, and must all exist.

## Dependency

Use pip or conda to install

- Python3(not sure whether version is requirement)

- requests
- bs4
- re
- os
- alive_progress

## Inputs

- html: URL of the original article
  - eg: https://mp.weixin.qq.com/s?__biz=MzU5MTgxMjYzNg==&amp;mid=2247502098&amp;idx=1&amp;sn=d4cc57addeaf9f0553626915f89fdd09&amp;chksm=fe2bc861c95c4177b4dd5b6c42fd4d9ff32edc2b016294bc5aa21b9ef43a12ae74433c91332b&token=636618258&lang=zh_CN#rd
- en_title: English version of the article title. Must not contain space, must not be duplicated
  - eg: attack_1
- author: when original article contains "作者" or "文字", then input is not needed, otherwise input the author name
  - eg: 妥圆

- category: Category of the article, select from Society, Politics...
  - eg: Society
- Time: Article written time, format: Month Date, Year
  - Eg: March 23, 2022

## How to run

- open terminal, change directory to the convert_html folder
- run `python3 convert_html.py`
- enter the needed information
- Done.
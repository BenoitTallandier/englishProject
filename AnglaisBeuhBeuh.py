from lxml import html
import requests

def getTranslation(word):
    page = requests.get('http://translate.reference.com/english/french/'+word)
    tree = html.fromstring(page.content);
    interest = tree.xpath('//textarea[@class="form-control targetArea"]/text()')
    return(interest[0])

def getDefinition(word):
    page = requests.get('http://www.dictionary.com/browse/'+word)
    tree = html.fromstring(page.content);
    interest = tree.xpath('//div[@class="def-content"]/text()')
    return(str(interest[0])[10:].replace(":","."))

print(getDefinition("drive"))

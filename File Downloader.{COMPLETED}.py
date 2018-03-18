import random
import urllib.request
def download(url,path,name,file_type):
    full_name=file_type + str(random.randrange(9000000, 9999999)) + str(name)
    full_path=path + full_name
    urllib.request.urlretrieve(url,full_path)

file_type=str(input('enter file type'))
name = '.' + str(input('enter extension name'))
path='downloads/'
url=str(input('enter url'))
download(url,path,name,file_type)
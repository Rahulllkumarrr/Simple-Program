from selenium import webdriver

driver=webdriver.Chrome()
driver.get('https://web.whatsapp.com/')

name="Pythontesting"
msg="Kuch bhi bolo"
count=2

input("scan qr code before entering")


user=driver.find_element_by_xpath('//span[@title="{}"]'.format(name))

user.click()

msg_box=driver.find_element_by_class_name('pluggable-input-compose')

for i in range(count):
    msg_box.send_keys(msg)
    button=driver.find_element_by_class_name('_2lkdt')
    button.click()

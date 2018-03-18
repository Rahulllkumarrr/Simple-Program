pets = {'bird':3.5,'cat': 5.0,'dog': 7.25,'gerbil': 1.5}
search=input("Enter pet name : \t")
try:
    price = pets[search]
    print(price)

except:
    print("Error occured : Name don't exist")

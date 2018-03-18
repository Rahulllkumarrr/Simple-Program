glass=[]
list1=[]


#for taking input in 2d array
for i in range(6):
    line=[int(z) for z in input().split()]
    #print(line)
    glass.append(line)
    #print(glass)

#print(glass)

for x in range(0,4):
    for y in range(0,4):
        s=sum(glass[x][y:y+3])+glass[x+1][y+1]+sum(glass[x+2][y:y+3])
        list1.append(s)
print(max(list1))

def staircase(n):
    for i in range(n,0,-1):
        list=""
        for z in range(1, (n + 1)):
            if z < i:
                list+=" "
            else:
                list+="#"
        print(list)


n = int(input().strip())
staircase(n)

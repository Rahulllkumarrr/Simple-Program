inputsize=int(input().strip())
for i in range(inputsize):
    string=str(input())
    even=string[0::2]
    odd=string[1::2]
    print(even,odd)
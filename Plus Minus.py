def plusMinus(arr):
    positive=0
    negative=0
    zero=0
    n=len(arr)
    for i in range(n):
        if arr[i]>0:
            positive+=1
        elif arr[i]<0:
            negative+=1
        else:
            zero+=1
    print(positive/n)
    print(negative/n)
    print(zero/n)

if __name__ == "__main__":
    n = int(input().strip())
    arr = list(map(int, input().strip().split(' ')))
    plusMinus(arr)
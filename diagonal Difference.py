def diagonalDifference(a):
    right,left=0,0
    n=len(a)
    l=n-1
    r=0
    for i in range(n):
        right=right+(a[r][r])
        left=left+a[r][l]
        r+=1
        l+=-1

    difference=abs(right-left)
    return difference

if __name__ == "__main__":
    n = int(input().strip())
    a = []
    for a_i in range(n):
       a_t = [int(a_temp) for a_temp in input().strip().split(' ')]
       a.append(a_t)
    result = diagonalDifference(a)
    print(result)
'''
Xsquare loves to play with strings a lot. Today, he has two strings S1 and S2
both consisting of lower case alphabets. Xsquare listed all subsequences of
string S1 on a paper and all subsequences of string S2 on a separate paper.
Xsquare wants to know whether there exists a string which is listed on both
the papers.

Xsquare thinks that this task is pretty boring and handed it to you.
Please accomplish this task on his behalf.

Input
First line of input contains a single integer T denoting the number of
test cases. Each test case consists of two lines. First line of each test
case contains a string denoting string S1. Next line of each test case
contains a string denoting string S2.

Output
For each test case, Print Yes if both papers contain a common string
otherwise Print No.



                                SAMPLE INPUT

                                2
                                phackerekarthj
                                jhakckerearthp
                                hello
                                buy



                                SAMPLE OUTPUT

                                Yes
                                No



Testcase 1 : There is a common subsequence of letters between S1 and S2.

For ex: "hackerearth" is subsequence of S1 and S2 both.

Testcase 2 : There is no common subsequence of letters between S1 and S2.


'''
n=int(input().strip())
for i in range(n):
    a=input().strip()
    b=input().strip()
    a=[str(x) for x in a]
    b=[str(y) for y in b]
    #print(a,b)
    l=min(len(a),len(b))
    for z in range(l):
        if len(a)>=len(b):
            if b[0] in a:
                a.remove(b[0])
                b.pop(0)
                if z==l-1:
                    print("Yes")
                continue
            else:
                print("No")
                break
        elif len(a) < len(b):
            if a[0] in b:
                b.remove(a[0])
                a.pop(0)
                if z==l-1:
                    print("Yes")
                continue
            else:
                print("No")
                break
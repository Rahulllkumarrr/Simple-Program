'''
PROBLEM
-------
Watson likes to challenge Sherlock's math ability. He will provide a starting and ending value describing a range of integers.
Sherlock must determine the number of square integers within that range, inclusive of the endpoints.

Note: A square integer is an integer which is the square of an integer, e.g. 1,4,9,16,25 .

Input Format

The first line contains T , the number of test cases.
Each of the next T lines contains two space-separated integers denoting A and B , the starting and ending

                Sample Input
                2
                3 9
                17 24

                Sample Output
                2
                0

Explanation

Test Case #00: In range [3,9], 4 and 9 are the two square integers.
Test Case #01: In range [17,24] , there are no square integers.


'''
import math
def squares(a, b):
    list = []
    start = int(math.sqrt(a))
    while ((start + 1) ** 2) <= b:
        z = start ** 2
        if z >= a:
            list.append(z)
        start += 1
    return len(list)


if __name__ == "__main__":
    q = int(input().strip())
    for a0 in range(q):
        a, b = input().strip().split(' ')
        a, b = [int(a), int(b)]
        result = squares(a, b)
        print(result)
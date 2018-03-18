'''
Cut the stick
-------------

You are given a number of sticks of varying lengths. You will iteratively cut
the sticks into smaller sticks, discarding the shortest pieces until there
are none left. At each iteration you will determine the length of the
shortest stick remaining, cut that length from each of the longer sticks
and then discard all the pieces of that shortest length. When all the
remaining sticks are the same length, they cannot be shortened so discard
them.

Given the lengths of n sticks, print the number of sticks that are left
before each iteration until there are none left.


Note: Before each iteration you must determine the current shortest stick.
-----

Input Format
-------------

The first line contains a single integer n .
The next line contains n space-separated integers: a0, a1,...an-1,
where ai represents the length of the ith stick in array arr.

Output Format
--------------

For each operation, print the number of sticks that are cut, on separate
lines.



                                Sample Input 0
                                6
                                5 4 4 2 2 8


                                Sample Output 0
                                6
                                4
                                2
                                1

 X--------X----------X--------X---------X----------X-----------------X----------X

                                Sample Input 1
                                8
                                1 2 3 4 3 3 2 1


                                Sample Output 1
                                8
                                6
                                4
                                1


'''


def cutTheSticks(arr):
    count1 = 0
    arr.sort()
    left = len(arr)
    list = []
    while left > 0:
        mini = min(arr)

        if left > 0:
            list.append(left)
        count1 = arr.count(mini)
        for i in range(len(arr)):
            arr[i] = arr[i] - mini

        for i in range(count1):
            arr.pop(0)
        left = len(arr)
    return list


if __name__ == "__main__":
    n = int(input().strip())
    arr = list(map(int, input().strip().split(' ')))
    result = cutTheSticks(arr)
    print("\n".join(map(str, result)))
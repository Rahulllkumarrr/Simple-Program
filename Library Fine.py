'''
Library Fine
------------

Your local library needs your help! Given the expected
and actual return dates for a library book,
create a program that calculates the fine (if any).
The fee structure is as follows:

1) If the book is returned on or before the expected
return date, no fine will be charged (i.e.: FINE=0).

2) If the book is returned after the expected return
 day but still within the same calendar month and
year as the expected return date,
 fine = 15 Hackos x (the number of days late).


3) If the book is returned after the expected return
month but still within the same calendar year as t
he expected return date, the
fine = 500 Hackos x (the number of months late).


4) If the book is returned after the calendar year in
which it was expected, there is a fixed fine of
10000 Hackos.


Charges are based only on the least precise measure
 of lateness. For example, whether a book is due
January 1, 2017 or December 31, 2017, if it is returned
January 1, 2018, that is a year late and the fine would be .


Input Format

The first line contains 3 space-separated integers
denoting the respective day,month and year on which the book was returned.

The second line contains 3 space-separated integers
 denoting the respective ,day , month and year on which the book was due
 to be returned.


                            Sample Input

                            9 6 2015
                            6 6 2015

                            Sample Output

                            45
'''

def libraryFine(d1, m1, y1, d2, m2, y2):
    if (y1==y2 and m1==m2 and d1<=d2) or (y1==y2 and m1<m2) or (y1<y2):
        return 0
    elif y1==y2 and m1==m2 and d1>d2:
        return (d1-d2)*15
    elif y1==y2 and m1>m2:
        return ((m1-m2)*500)
    elif y1>y2:
        return 10000


if __name__ == "__main__":
    d1, m1, y1 = input().strip().split(' ')
    d1, m1, y1 = [int(d1), int(m1), int(y1)]
    d2, m2, y2 = input().strip().split(' ')
    d2, m2, y2 = [int(d2), int(m2), int(y2)]
    result = libraryFine(d1, m1, y1, d2, m2, y2)
    print(result)

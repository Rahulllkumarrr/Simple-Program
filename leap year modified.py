def is_leap(year):
    leap = False
    if (year%4==0 and year%100!=0) or (year%400==0):
        leap=True
    print(leap)
    return leap

years=[1800, 1900, 2100, 2000,2200, 2300 ]

for year in years:
    is_leap(year)
for i in range(3):
    print("1st")
    for z in range(3):
        print("2nd")
        if i==1 or z ==1:
            print("______________________")
            print("Skipping {},{}".format(i,z))
            print("______________________")
            break
        else:
            print("______________________")
            print(i,z)
            print("______________________")
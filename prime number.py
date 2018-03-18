# Python Program - Print Prime Numbers

while True:
    print("Enter 'x' for exit.")
    print("Enter starting and ending number: ")
    start = input()
    end = input()
    if start == 'x':
        break
    else:
        lower_number = int(start)
        upper_number = int(end)
        print("\nPrime Numbers between the given range:")
        for num in range(lower_number, upper_number + 1):
            if num > 1:
                for i in range(2, num):
                    if (num % i) == 0:
                        break
                else:
                    print(num)

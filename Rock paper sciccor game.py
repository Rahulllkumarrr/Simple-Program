import random
import time
game=["Rock","Paper","Sciccors","Thread"]

for i in range(5):
    print("Rock")
    time.sleep(0.5)
    print("Paper")
    time.sleep(0.5)
    print("Scissors")
    time.sleep(0.5)
    print("Thread\n")
    time.sleep(0.5)
    print(game[random.randint(0,3)])
    print("\n")
    time.sleep(3)

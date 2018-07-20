x = input('Input your paragraph for Counting: ')
x = x.replace(',',' ')
x = x.replace('.',' ')
s = x.split(' ')
o = 0
for i in s:
    if (i != ""):
        o = o + 1
print(o)

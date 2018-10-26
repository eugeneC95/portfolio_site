x = input('Enter The String To Check: ')
xarray = list(x)
if(xarray[0] == xarray[-1]):
    print('It is palindrome.')
else:
    print('The string is not a palindrome.')

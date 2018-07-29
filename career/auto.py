import pyautogui
import numpy as np
from PIL import ImageGrab
import cv2
import time

def screen_record():
    last_time = time.time()
    i = 0
    status = ""
    while(True):
        printscreen =  np.array(ImageGrab.grab(bbox=(0,50,600,430)))
        #print('loop took {} seconds'.format(time.time()-last_time))
        last_time = time.time()
        #time.sleep(0.0001)
        i += 1
        if i > 100:
            i = 0
        if i % 6 == 0:
            img = "notifi.png"
            status = "notifi"
            print(i,"notifi")
        elif i % 3 == 0:
            img = "energy.png"
            status = "false"
            print(i,"energy")
        elif i % 4 == 0:
            img = "manager.png"
            status = "manager"
            print(i,"manager")
        elif i % 5 == 0:
            img = "susume.png"
            status = "susume"
            print(i,"susume")

        elif i % 7 == 0:
            img = "coins.png"
            status = "false"
            print(i,"coins")
        else:
            img = "fill.png"
            status = "true"
            print(i,"fillstuff")
        new_screen = process_img(printscreen,img,status)
        cv2.imshow('window',cv2.cvtColor(new_screen, cv2.COLOR_BGR2RGB))

        if cv2.waitKey(25) & 0xFF == ord('q'):
            cv2.destroyAllWindows()
            break
def process_img(image,img,status):
    original_image = image
    processed_img = cv2.cvtColor(image, cv2.COLOR_RGB2GRAY)
    #processed_img =  cv2.Canny(processed_img, threshold1 = 200, threshold2=300)
    template = cv2.imread(img, cv2.IMREAD_GRAYSCALE)
    w, h = template.shape[::-1]
    res = cv2.matchTemplate(processed_img,template,cv2.TM_CCOEFF_NORMED)
    loc = np.where( res >= 0.8)
    for pt in zip(*loc[::-1]):
        cv2.rectangle(image, pt, (pt[0] + w, pt[1] + h), (255,0,0),1)
        if status == "true":
            pyautogui.moveTo(pt[0]+9, pt[1]+9+55, duration=0.2)
            print("moveTo",pt[0]+9, pt[1]+9+55)
            pyautogui.click(pt[0]+9, pt[1]+9+55)
            print("Click",pt[0]+9, pt[1]+9+55)
            pyautogui.moveTo(70,250,duration=0.5)
            print("moveTo",70, 250)
            time.sleep(0.2)
            pyautogui.click(70,250)
            time.sleep(0.5)
            pyautogui.moveTo(pt[0]+9, pt[1]+9+55)
            time.sleep(0.2)
            pyautogui.click(pt[0]+9, pt[1]+9+55)
            pyautogui.click(pt[0]+6, pt[1]+9+55)
            break
        elif status == "notifi":
            pyautogui.moveTo(pt[0]+9, pt[1]+9+55, duration=0.2)
            pyautogui.click(pt[0]+9, pt[1]+9+55)
            break
        elif status == "manager":
            pyautogui.moveTo(pt[0]+9, pt[1]+9+55, duration=0.2)
            pyautogui.click(pt[0]+9, pt[1]+9+55)
            time.sleep(7)
            break
        elif status == "susume":
            pyautogui.moveTo(pt[0]-10, pt[1]+9+55, duration=0.2)
            pyautogui.click(pt[0]-10, pt[1]+9+55)
            break
        else:
            pyautogui.moveTo(pt[0]+9, pt[1]+9+55, duration=0.2)
            pyautogui.click(pt[0]+9, pt[1]+9+55)
            break
    return image
screen_record()

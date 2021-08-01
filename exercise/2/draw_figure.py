import numpy as np
import cv2

my_img = np.zeros((400, 400, 3), dtype = "uint8")

cv2.circle(my_img, (50, 50), 28, (0, 20, 200), 2)

penta = np.array([[[10,50],[30,85],[70,85],[90,50],[70,15],[30,15]]], np.int32)
cv2.polylines(my_img, [penta], True, (255,120,255),3)

rhombus = np.array([[[30,50],[50,70],[70,50],[50,30]]], np.int32)
cv2.polylines(my_img, [rhombus], True, (255,120,255),2)

cv2.imshow('Window', my_img)
cv2.waitKey(0)
cv2.destroyAllWindows()


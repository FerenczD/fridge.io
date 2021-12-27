from pykinect import nui
import numpy
import cv2
import os.path
from os.path import join as pjoin

def getColorImage(frame):
	rgb = numpy.empty((480, 640, 4), numpy.uint8)
	frame.image.copy_bits(rgb.ctypes.data)
	cv2.imshow('Kinect Video', rgb)
	cv2.imwrite('image.jpg', rgb)

def main():
	kinect = nui.Runtime()
	kinect.video_frame_ready += getColorImage
	kinect.video_stream.open(nui.ImageStreamType.Video, 2, nui.ImageResolution.Resolution640x480,nui.ImageType.Color)
	cv2.namedWindow('Kinect Video', cv2.WINDOW_AUTOSIZE)
	while True:
		key = cv2.waitKey(1)
		if key == 0x1B:
			break

	cv2.destroyAllWindows()
	kinect.close()
	
	
if __name__ == '__main__':
    main()
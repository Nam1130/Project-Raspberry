import RPi.GPIO as GPIO
import time
GPIO.setmode(GPIO.BOARD)
SOUND_INPUT=40
RELAY_OUTPUT=32
GPIO.setup(SOUND_INPUT,GPIO.IN)#######Digital input
GPIO.setup(RELAY_OUTPUT,GPIO.OUT)#####Digital output
GPIO.setwarnings(False)
ch_flag=False
try:
    while True:
        if  GPIO.input(SOUND_INPUT)==1:#sound detected
            ch_flag= (not ch_flag)#toggle
            GPIO.output(RELAY_OUTPUT,ch_flag)
            print("Lights ON" if ch_flag else "Lisghts Off")
            time.sleep(.5)
except(KeyboardInterrupt):
    print("cleaning up..")
    GPIO.cleanup()

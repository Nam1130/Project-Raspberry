import pymysql
import RPi.GPIO as GPIO
import time
import datetime
GPIO.setmode(GPIO.BOARD)
REED_INPUT=36
LED_OUTPUT=38
GPIO.setup(REED_INPUT,GPIO.IN)#######Digital input
GPIO.setup(LED_OUTPUT,GPIO.OUT)#####Digital output
GPIO.setwarnings(False)
a =0
b= 0

try:
    while True:
        if  GPIO.input(REED_INPUT)!=1:
            a =1
            GPIO.output(LED_OUTPUT,GPIO.HIGH)
            if b-a ==1:
                GPIO.output(LED_OUTPUT,GPIO.LOW)
                print "Open door"
                a = 0
                b = 0
                today = datetime.date.today()
                time = datetime.datetime.now()
                conn=pymysql.connect(host='localhost',user='root',password='root',db='db')
                myCursor = conn.cursor()
                sql = "INSERT INTO CheckOut (Date,Time,Note) VALUE (%s, %s, %s)"
                val = (today, time, 1)
                myCursor.execute(sql, val)
                conn.commit()
                conn.close()
        if  GPIO.input(REED_INPUT)==1:
            b = 2
            GPIO.output(LED_OUTPUT,GPIO.LOW)
            
except(KeyboardInterrupt):
    print("cleaning up..")
    GPIO.cleanup()


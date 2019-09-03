import pymysql

conn=pymysql.connect(host='localhost',user='root',password='root',db='test')

a = conn.cursor()
sql = "INSERT INTO `contact`(`name`,`phone`) VALUE ('aaa',234234)"
# sql = 'SELECT * FROM `CheckOut`;'
a.execute(sql)

countrow = a.execute(sql)

print("number rows")
data = a.fetchmany()

print(data)

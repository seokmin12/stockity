import socket
import pandas_datareader._utils
import urllib3
from bs4 import BeautifulSoup
import requests
import FinanceDataReader as fdr
from datetime import datetime
import telegram
from dateutil.relativedelta import relativedelta
from pandas import DataFrame
from fbprophet import Prophet
import math
import pymysql
import matplotlib.pyplot as plt

conn = pymysql.connect(host='127.0.0.1', user='root', password='seokmin68', db='stock', port=3307)
curs = conn.cursor()

delete_sql = "DROP TABLE nasdaq_stock"

curs.execute(delete_sql)
conn.commit()
print(f'{datetime.now()} - DELETE PREVIOUS TABLE')

create_sql = "CREATE TABLE nasdaq_stock (number INT NOT NULL AUTO_INCREMENT, symbol VARCHAR(200) NOT NULL, now_price VARCHAR(200) NOT NULL, target_price VARCHAR(200) NOT NULL, predict_price VARCHAR(200) NOT NULL NOT NULL, aft_market_price VARCHAR(200) NOT NULL, aft_market_rate VARCHAR(200) NOT NULL, PRIMARY KEY(number));"
curs.execute(create_sql)
conn.commit()
print(f'{datetime.now()} - CREATE NEW TABLE')

telegram_token = '1801532879:AAHdAYqh9cjMyoT4V4k0zTZe5t7iMRfmBHg'
bot = telegram.Bot(token=telegram_token)

df_nasdaq = fdr.StockListing('NASDAQ')
symbols = list(df_nasdaq['Symbol'])
symbol_list = []
for i in symbols:
    symbol_list.append(i.lower())
print("Working...")


def get_aft_market_price(symbol):
    df = fdr.DataReader(symbol).tail(1)

    strategy = (float(df['High']) - float(df['Low'])) * 1.3
    target_price = float(df['Close']) + strategy
    target_price = round(target_price, 2)

    header = {
        'User-Agent': 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_15_7) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/90.0.4430.212 Safari/537.36'}

    html = requests.get(f"https://www.webull.com/quote/nasdaq-{symbol}", headers=header, timeout=200)
    soup = BeautifulSoup(html.content, "html.parser")
    aft_market_price = "'" + soup.select_one("div.jss1xij2a5 > div").text + "'"
    aft_market_rate = soup.select_one("div.jss1xij2a5 > div > span").text.split(' ')
    aft_market_rate = aft_market_rate[0] + ' ' + aft_market_rate[2]

    if aft_market_price.find('After'):
        aft_market_price = 'Aft. ' + aft_market_rate

    now = datetime.now()

    start = now - relativedelta(years=1)
    end = now.strftime('%Y-%m-%d')

    # money = 65

    df = fdr.DataReader(item, start, end)
    df = df.reset_index()

    raw_data = {'ds': list(df['Date']),
                'y': list(df['Close'])}

    data = DataFrame(raw_data)

    model = Prophet(yearly_seasonality=True)
    model.fit(data)

    future = model.make_future_dataframe(periods=1, freq='D')
    forecast = model.predict(future)

    now_price = float(df['Close'].tail(1))

    predict_trend = list(forecast['trend'])[-1]
    predict_price = round(predict_trend - now_price, 3)

    # can_buy_stock_amount = math.trunc(float(money) / now_price)
    # if target_price * can_buy_stock_amount == 0:
    #     profit = 0.0
    # else:
    #     profit = round((now_price + round(predict_price, 3)) * can_buy_stock_amount / (target_price * can_buy_stock_amount) * 100 - 100, 3)

    insert_sql = "INSERT INTO nasdaq_stock (symbol, now_price, target_price, predict_price, aft_market_price, aft_market_rate) VALUES (%s, %s, %s, %s, %s, %s)"

    print("\n\n#############################################################################")
    print(f"##  {datetime.now()} - Symbol:{symbol.upper()}  Now_Price: ${now_price}, Target_Price: ${target_price}")
    print("#############################################################################\n")
    val = (symbol.upper(), now_price, target_price, predict_price, aft_market_price, aft_market_rate[0])
    curs.execute(insert_sql, val)

    conn.commit()

    print(curs.rowcount, "record inserted\n")


for item in symbol_list:
    try:
        get_aft_market_price(item)
    except AttributeError:
        print(f"{datetime.now()} - Can't find '{item}' price")
    except pandas_datareader._utils.RemoteDataError:
        print(f"{datetime.now()} - '{item}' is delisted")
    except (socket.timeout, requests.exceptions.ReadTimeout, urllib3.exceptions.ReadTimeoutError):
        print(f"{datetime.now()} - Timeout")
    except KeyError:
        bot.sendMessage(chat_id='1832322351', text="All Symbols Recorded")
        break

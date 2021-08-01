import socket
import pandas_datareader._utils
import urllib3
from bs4 import BeautifulSoup
import requests
import FinanceDataReader as fdr
from datetime import datetime
import telegram

telegram_token = '1801532879:AAHdAYqh9cjMyoT4V4k0zTZe5t7iMRfmBHg'
bot = telegram.Bot(token=telegram_token)

df_nasdaq = fdr.StockListing('NASDAQ')
symbols = list(df_nasdaq['Symbol'])
symbol_list = []
for i in symbols:
    symbol_list.append(i.lower())
print("Working...")


def get_pre_market_price(symbol):
    df = fdr.DataReader(symbol).tail(1)

    strategy = (float(df['High']) - float(df['Low'])) * 0.3
    target_price = float(df['Close']) + strategy
    target_price = round(target_price, 2)

    header = {'User-Agent': 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_15_7) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/91.0.4472.114 Safari/537.36'}
    html = requests.get(f"https://www.webull.com/quote/nasdaq-{symbol}", headers=header, timeout=120)
    soup = BeautifulSoup(html.content, "html.parser")
    pre_market_price = "'" + soup.select_one("div.jss1xij2a5 > div").text + "'"
    pre_market_rate = soup.select_one("div.jss1xij2a5 > div > span").text.split(' ')
    pre_market_rate = pre_market_rate[0] + ' ' + pre_market_rate[2]

    if pre_market_price.find('After'):
        pre_market_price = 'Aft. ' + pre_market_rate
    elif pre_market_price.find('Pre'):
        pre_market_price = 'Pre. ' + pre_market_rate

    if float(pre_market_rate[0]) >= target_price:
        print(f'{datetime.now()} - Symbol: {symbol.upper()}, Target_Price: ${target_price}, {pre_market_price}')
        bot.sendMessage(chat_id='1832322351', text=f'{datetime.now()} - Symbol: {symbol.upper()}, Target_Price: ${target_price}, {pre_market_price}')


n = 0

for item in symbol_list:
    try:
        get_pre_market_price(item)
        n += 1
        print(n)
    except AttributeError:
        print(f"{datetime.now()} - Can't find '{item}' price")
    except pandas_datareader._utils.RemoteDataError:
        print(f"{datetime.now()} - '{item}' is delisted")
    except (socket.timeout, requests.exceptions.ReadTimeout, urllib3.exceptions.ReadTimeoutError):
        print(f"{datetime.now()} - Timeout")
    except KeyError:
        break

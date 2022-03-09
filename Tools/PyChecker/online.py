import json
import random
import sys
import re
import threading
import time
import os
from concurrent.futures import ThreadPoolExecutor
import websocket
from colorama import Fore
from colorama import init, Fore, Back, Style

init(convert=True)

def online(token, game, type, status):
    ws = websocket.WebSocket()
    if status == "random":
        stat = ['online', 'dnd', 'idle']
        status = random.choice(stat)
    ws.connect('wss://gateway.discord.gg/?v=6&encoding=json')
    hello = json.loads(ws.recv())
    heartbeat_interval = hello['d']['heartbeat_interval']
    if type == "Playing":
        gamejson = {
            "name": game,
            "type": 0
        }
    elif type == 'Streaming':
        gamejson = {
            "name": game,
            "type": 1,
            "url": "https://www.twitch.tv/discord.gg/AVKEJtWkBj"
        }
    elif type == "Listening":
        gamejson = {
            "name": game,
            "type": 2
        }
    elif type == "Watching":
        gamejson = {
            "name": game,
            "type": 3
        }
    auth = {
        "op": 2,
        "d": {
            "token": token,
            "properties": {
                "$os": sys.platform,
                "$browser": "RTB",
                "$device": f"{sys.platform} Device"
            },
            "presence": {
                "game": gamejson,
                "status": status,
                "since": 0,
                "afk": False
            }
        },
        "s": None,
        "t": None
    }
    ws.send(json.dumps(auth))
    ack = {
        "op": 1,
        "d": None
    }
    while True:
        time.sleep(heartbeat_interval / 1000)
        try:
            ws.send(json.dumps(ack))
        except Exception as e:
            break


def main():
    types = ['Playing', 'Streaming', 'Watching', 'Listening']
    type = input(f'''
    
                                         ██████╗ ██████╗  ██████╗██╗  ██╗
                                        ██╔════╝██╔═══██╗██╔════╝██║ ██╔╝
                                        ██║     ██║   ██║██║     █████╔╝ 
                                        ██║     ██║   ██║██║     ██╔═██╗ 
                                        ╚██████╗╚██████╔╝╚██████╗██║  ██╗
                                         ╚═════╝ ╚═════╝  ╚═════╝╚═╝  ╚═╝
                                 


                                Options: Playing | Streaming | Watching | Listening
    
Your Choice > ''')
    os.system("cls")
    game = input(f'''
    
                                         ██████╗ ██████╗  ██████╗██╗  ██╗
                                        ██╔════╝██╔═══██╗██╔════╝██║ ██╔╝
                                        ██║     ██║   ██║██║     █████╔╝ 
                                        ██║     ██║   ██║██║     ██╔═██╗ 
                                        ╚██████╗╚██████╔╝╚██████╗██║  ██╗
                                         ╚═════╝ ╚═════╝  ╚═════╝╚═╝  ╚═╝
                                 


                                    Info: Type what you want the status to be
    
Status > ''')
    status = ['online', 'dnd', 'idle','random']
    status = status[3]
    executor = ThreadPoolExecutor(max_workers=1000)
    for token in open("tokens.txt","r+").readlines():
        threading.Thread(target=lambda : online(token.replace("\n",""), game, type, status)).start()
    os.system("cls")
    print(f"{Fore.LIGHTRED_EX}[{Fore.RESET}!{Fore.LIGHTRED_EX}]{Fore.RESET} Tokens Online")

main()

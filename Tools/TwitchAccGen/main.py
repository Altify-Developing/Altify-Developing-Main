from typing import List, Dict
import requests, random, string, time, json, threading, traceback
from requests.packages.urllib3.exceptions import InsecureRequestWarning
from ssl import create_default_context
from twocaptcha import TwoCaptcha
#from urllib3.contrib.socks import SOCKSProxyManager

config = json.loads(open("./config/config.json", "r", encoding="utf-8").read())
requests.packages.urllib3.disable_warnings(InsecureRequestWarning)
usedProxy = []


class color:
    GREEN = "\033[92m"
    YELLOW = "\033[93m"
    RED = "\033[91m"
    RESET_ALL = "\033[0m"


def getProxy():
    if config['proxyType'] == "socks5":
        with open('./assets/proxies.txt', encoding="utf-8") as f:
            lines = f.readlines()
            landline = random.choice(lines).split('\n')[0]
        return {'http': f'socks5://{landline}', 'https': f'socks5://{landline}'}

    elif config['proxyType'] == "http/https":
        with open('./assets/proxies.txt', encoding="utf-8") as f:
            lines = f.readlines()

            landline = random.choice(lines).split('\n')[0]

        return {"http": f"http://{landline}", "https": f"https://{landline}"}

    elif config['proxyType'] == "http":
        with open('./assets/proxies.txt', encoding="utf-8") as f:
            lines = f.readlines()
            landline = random.choice(lines).split('\n')[0]

        return {"http": f"http://{landline}"}


def write(file: str, text: str):
    with open(file, "a+") as f:
        return f.write(text)


def password() -> str:
    characters = string.ascii_letters + string.punctuation + string.digits
    randomPassword = "".join(random.choice(characters) for x in range(random.randint(8, 16)))
    return randomPassword


def birthday() -> Dict[str, int]:
    year = random.randint(1980, 2002)
    month = random.randint(1, 12)
    day = random.randint(1, 25)

    return {
        "day": day,
        "month": month,
        "year": year
    }


def userAgent() -> str:
    with open("./assets/userAgents.txt", encoding="utf-8") as f:
        lines = f.readlines()
        randomize = random.choice(lines)
    return randomize.split("\n")[0]


def randomString(a) -> str:
    letters = string.ascii_letters
    result_str = "".join(random.choice(letters) for i in range(a))
    return result_str


def randomUsername() -> str:
    with open("./assets/usernames.txt", encoding="utf-8") as f:
        lines = f.readlines()
        randomize = random.choice(lines)
    return randomize.split("\n")[0]


def solveCaptcha(count, session):
    import time
    ss = session
    sitekey = "E5554D43-23CC-1982-971D-6A2262A2CA24"
    siteurl = "https://www.twitch.tv/"
    getCapthcaid = ss.get(
        f"https://2captcha.com/in.php?key={config['2capthcaKey']}&method=funcaptcha&publickey={sitekey}&pageurl={siteurl}") \
        .text
    #print(getCapthcaid)
    if getCapthcaid == "ERROR_ZERO_BALANCE":
        print(f"{color.RED}[{count}] Your 2captcha account is empty, please refill it.{color.RESET_ALL}")
        return False

    getCapthcaid = getCapthcaid.split("|")[1]
    capthcaAnswer = ss.get(
        f"https://2captcha.com/res.php?key={config['2capthcaKey']}&action=get&id={getCapthcaid}").text

    print(f"{color.YELLOW}[{count}] Waiting for captcha to be resolved. {color.RESET_ALL}")
    while "CAPCHA_NOT_READY" in capthcaAnswer:
        time.sleep(5)
        capthcaAnswer = ss.get(f"https://2captcha.com/res.php?key={config['2capthcaKey']}&action=get&id={getCapthcaid}") \
            .text
    print(f"{color.GREEN}[{count}] Captcha successfully resolved {color.RESET_ALL}")
    solvedCaptcha = capthcaAnswer.split("|")[1]
    print(solvedCaptcha)
    return solvedCaptcha


def solve(count) -> str:
    catpchakey = config['2capthcaKey']; solver = TwoCaptcha(catpchakey)
    print(f"{color.YELLOW}[{count}] Waiting for captcha to be resolved. {color.RESET_ALL}")

    try:
        result = solver.funcaptcha(sitekey="E5554D43-23CC-1982-971D-6A2262A2CA24", url=f"https://www.twitch.tv/", version="v3", score=0.1)

    except Exception as err:
        if "ERROR_ZERO_BALANCE" in str(err):
            print(f"{color.RED}[-]{color.RESET_ALL} Error: [2CAPTCHA] api balance is {color.RED}ZERO{color.RESET_ALL}")
            quit()
        print(f"{color.RED}[-]{color.RESET_ALL} CAPTCHA API ERROR: {err}")
        return False

    else:
        print(f"{color.GREEN}[{count}] Captcha resolved successfully. {color.RESET_ALL}")
        #print(f"{str(result['code'])}")
        return str(result["code"])


class Gmailnator:
    BASE_URL = 'https://www.gmailnator.com/'
    context = create_default_context()
    HEADERS = {
        'authority': 'www.gmailnator.com',
        'sec-ch-ua': '^\\^Google',
        'accept': 'application/json, text/javascript, */*; q=0.01',
        'x-requested-with': 'XMLHttpRequest',
        'sec-ch-ua-mobile': '?0',
        'user-agent': 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/87.0.4280.88 Safari/537.36',
        'content-type': 'application/x-www-form-urlencoded; charset=UTF-8',
        'origin': 'https://www.gmailnator.com',
        'sec-fetch-site': 'same-origin',
        'sec-fetch-mode': 'cors',
        'sec-fetch-dest': 'empty',
        'referer': 'https://www.gmailnator.com/inbox/',
        'accept-language': 'en-US,en;q=0.9,',
        'sec-gpc': '1'
    }

    def __init__(self):
        self.s = requests.Session()
        #
        self.csrf_token = self.__get_csrf()

    def __get_csrf(self):
        response = self.s.get(self.BASE_URL, verify=False)
        csrf_token = response.cookies.get('csrf_gmailnator_cookie')
        return csrf_token


class GmailnatorRead(Gmailnator):
    def __init__(self, email, raw_email, types):
        super().__init__()
        self.type = types
        self.email = email
        self.raw_email = raw_email

    def __get_email_name(self):
        name_only = '(^.*?(?=[%|@])[%|@])'
        x = re.search(name_only, self.email)
        filter0 = x.group()

        filter1 = filter0.replace('%', '')
        filter2 = filter1.replace('@', '')

        return filter2

    def __requests_mailbox(self):
        if self.type == 'dot':
            data = f'csrf_gmailnator_token={self.csrf_token}&action=LoadMailList&Email_address={self.raw_email}'

        if self.type == 'plus':
            data = f'csrf_gmailnator_token={self.csrf_token}&action=LoadMailList&Email_address={self.email}'

        r = self.s.post(self.BASE_URL + 'mailbox/mailboxquery', data=data, headers=self.HEADERS, verify=False)
        return r

    def get_inbox(self):
        json_inbox = self.__requests_mailbox().json()
        inbox_content = []
        try:
            for email in range(len(json_inbox)):
                inbox_content.append(str(json_inbox[email]['content']))

        except Exception as e:
            print(e)
            inbox_content = ''

        return inbox_content

    def get_single_message(self, msg_id):
        email_name = self.__get_email_name()
        data = f'csrf_gmailnator_token={self.csrf_token}&action=get_message&message_id={msg_id}&email={email_name}'

        r = self.s.post(self.BASE_URL + 'mailbox/get_single_message/', data=data, headers=self.HEADERS, verify=False)

        return r.json()['content']


class GmailnatorGet(Gmailnator):
    def __init__(self):
        super().__init__()

    def get_email(self):
        payload = {
            'csrf_gmailnator_token': self.csrf_token,
            'action': 'GenerateEmail',
            'data[]': 1,
            'data[]': 2,
            'data[]': 3,
        }

        r = self.s.post('https://www.gmailnator.com/index/indexquery', data=payload, verify=False)
        return r.text


def dfilter_email(email):
    at_replace = email.replace('@', '%40')

    dot_replace = at_replace.replace('.', '')

    final = dot_replace.replace('com', '.com')
    return final


def pfilter_email(email):
    at_replace = email.replace('@', '%40')

    plus_replace = at_replace.replace('+', '%2B')

    return plus_replace


def find_email_type(email):
    dot_counter = 0
    for i in email:
        if i == '+':
            return 'plus'
        if i == '.':
            dot_counter += 1
        if dot_counter > 1:
            return 'dot'


class TwitchGenerator:

    def __init__(self, proxy, count):
        self.proxy = proxy
        self.count = count
        self.session = requests.Session()
        if config["useProxy"]:
            self.session.proxies.update(proxy)
        self.session.headers.update({"User-Agent": userAgent()})

    def register(self):

        g = GmailnatorGet()
        newEmail = g.get_email()

        emailType = find_email_type(newEmail)

        if emailType == "dot":
            filteredEmail = dfilter_email(newEmail)

        if emailType == 'plus':
            filteredEmail = pfilter_email(newEmail)

        payload = {
            "username": randomUsername() + randomString(4),
            "password": password(),
            "email": newEmail,
            "birthday": birthday(),
            "client_id": "kimne78kx3ncx6brgo4mv6wki5h1ko",
            "include_verification_code": True,
            "arkose": {"token": solve(self.count)}
        }

        headers = {
            "authority": "passport.twitch.tv",
            "method": "POST",
            "path": "/register",
            "scheme": "https",
            "accept": "*/*",
            "accept-encoding": "gzip, deflate, br",
            "accept-language": "en-US,en;q=0.9,tr;q=0.8",
            "content-length": str(len(str(payload).replace(" ", "").replace("None", "null")) + 2),
            "content-type": "text/plain;charset=UTF-8",
            "cookie": "",
            "origin": "https://www.twitch.tv",
            "referer": "https://www.twitch.tv/",
            "sec-ch-ua": '"Microsoft Edge";v="93", " Not;A Brand";v="99", "Chromium";v="93"',
            "sec-ch-ua-mobile": "?0",
            "sec-ch-ua-platform": '"Windows"',
            "sec-fetch-dest": "empty",
            "sec-fetch-mode": "cors",
            "sec-fetch-site": "same-site",
            "user-agent": self.session.headers["User-Agent"]
        }

        re = self.session.post(f"https://passport.twitch.tv/register", json=payload, headers=headers,
                               timeout=config["timeout"])
        print(re.json())
        if "access_token" in re.text:
            token = re.json()["access_token"]
            print(f"""{color.GREEN}[{self.count}] ACCOUNT CREATED:
--------------------------------------------------------------
USERNAME: {payload['username']}
EMAIL: {payload['email']}
PASSWORD: {payload['password']}
TOKEN: {token}
--------------------------------------------------------------{color.RESET_ALL}
            """)

            write(file="./out/tokens.txt", text=f"{token}\n")
            write(file="./out/tokenInfo.txt",
                  text=f"{payload['username']}:{payload['email']}:{payload['password']}:{token}\n")

        print(f"{color.GREEN}[{self.count}] Process finished.{color.RESET_ALL}")


class worker:

    def deleteProxy(linename):
        a_file = open("./assets/proxies.txt", "r")

        lines = a_file.readlines()
        a_file.close()

        new_file = open("./assets/proxies.txt", "w")
        for line in lines:
            if line.strip("\n") != linename:
                new_file.write(line)

        new_file.close()

    def tharding(thread, adet):
        try:
            tx = []
            for i in range(adet):
                if threading.active_count() <= thread:
                    randomProxy = getProxy()
                    usedProxy.append(randomProxy)
                    if config["deleteUsedProxy"]:
                        worker.deleteProxy(usedProxy[0]["http"].split('//')[1])
                    mT = threading.Thread(target=TwitchGenerator(usedProxy[0], i + 1).register)
                    usedProxy.clear()
                    mT.daemon = True
                    mT.start()
                    tx.append(mT)
            for t in tx:
                t.join(75)
        except Exception as e:
            traceback.print_exc()
            pass


if __name__ == "__main__":
    worker.tharding(config["threading"], config["Number_of_accounts_to_be_created"])

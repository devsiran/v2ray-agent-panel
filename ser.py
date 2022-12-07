import requests
import time
import json
import urllib
import os

# <Config Vars>
servers_hash = {SERVER_HASH_HERE}
apiAddress = "{ADMIN_ADDRESS_HERE}"
# </Config Vars>

servers_hash = json.dumps(servers_hash)
servers_hash = urllib.parse.quote(servers_hash)

def make_trojan_gRPC(us):
    isChanged = False;
    confFile = "/etc/v2ray-agent/xray/conf/04_trojan_gRPC_inbounds.json"
    inbounds = []
    for u in us:
        inbounds.append({
            "email" : str(u.randomKey) + "@mylast.tk" ,
            "password": str(u.randomKey)
        })
    f = open(confFile, "r")
    myf = json.loads(f.read())
    f.close()
    if json.dumps(myf['inbounds'][0]['settings']['clients']) != json.dumps(inbounds):
        isChanged = True
        myf['inbounds'][0]['settings']['clients'] = inbounds
        f = open(confFile, "w")
        f.write(json.dumps(myf))
        f.close()
    return isChanged

def make_VLESS_gRPC(us):
    isChanged = False;
    confFile = "/etc/v2ray-agent/xray/conf/06_VLESS_gRPC_inbounds.json"
    inbounds = []
    for u in us:
        inbounds.append({
            "email" : str(u.randomKey) + "@mylast.tk" ,
            "id": str(u.randomKey)
        })
    f = open(confFile, "r")
    myf = json.loads(f.read())
    f.close()
    if json.dumps(myf['inbounds'][0]['settings']['clients']) != json.dumps(inbounds):
        isChanged = True
        myf['inbounds'][0]['settings']['clients'] = inbounds
        f = open(confFile, "w")
        f.write(json.dumps(myf))
        f.close()
    return isChanged

def make_VLESS_TCP(us):
    isChanged = False;
    confFile = "/etc/v2ray-agent/xray/conf/02_VLESS_TCP_inbounds.json"
    inbounds = []
    for u in us:
        inbounds.append({
            "email" : str(u.randomKey) + "@mylast.tk",
            "flow": "xtls-rprx-direct",
            "id": str(u.randomKey)
        })
    f = open(confFile, "r")
    myf = json.loads(f.read())
    f.close()
    if json.dumps(myf['inbounds'][0]['settings']['clients']) != json.dumps(inbounds):
        isChanged = True
        myf['inbounds'][0]['settings']['clients'] = inbounds
        f = open(confFile, "w")
        f.write(json.dumps(myf))
        f.close()
    return isChanged

def make_trojan_TCP(us):
    isChanged = False;
    confFile = "/etc/v2ray-agent/xray/conf/04_trojan_TCP_inbounds.json"
    inbounds = []
    for u in us:
        inbounds.append({
            "email" : str(u.randomKey) + "@mylast.tk",
            "password": str(u.randomKey)
        })
    f = open(confFile, "r")
    myf = json.loads(f.read())
    f.close()
    if json.dumps(myf['inbounds'][0]['settings']['clients']) != json.dumps(inbounds):
        isChanged = True
        myf['inbounds'][0]['settings']['clients'] = inbounds
        f = open(confFile, "w")
        f.write(json.dumps(myf))
        f.close()
    return isChanged

def make_VLESS_WS(us):
    isChanged = False;
    confFile = "/etc/v2ray-agent/xray/conf/03_VLESS_WS_inbounds.json"
    inbounds = []
    for u in us:
        inbounds.append({
            "email" : str(u.randomKey) + "@mylast.tk",
            "id": str(u.randomKey)
        })
    f = open(confFile, "r")
    myf = json.loads(f.read())
    f.close()
    if json.dumps(myf['inbounds'][0]['settings']['clients']) != json.dumps(inbounds):
        isChanged = True
        myf['inbounds'][0]['settings']['clients'] = inbounds
        f = open(confFile, "w")
        f.write(json.dumps(myf))
        f.close()
    return isChanged

def make_VMess_WS(us):
    isChanged = False;
    confFile = "/etc/v2ray-agent/xray/conf/05_VMess_WS_inbounds.json"
    inbounds = []
    for u in us:
        inbounds.append({
            "email" : str(u.randomKey) + "@mylast.tk",
            "id": str(u.randomKey),
            "alterId": 0
        })
    f = open(confFile, "r")
    myf = json.loads(f.read())
    f.close()
    if json.dumps(myf['inbounds'][0]['settings']['clients']) != json.dumps(inbounds):
        isChanged = True
        myf['inbounds'][0]['settings']['clients'] = inbounds
        f = open(confFile, "w")
        f.write(json.dumps(myf))
        f.close()
    return isChanged

while(1):
    try:
        isChanged = False
        res = requests.get(apiAddress + servers_hash).json()
        if "trojan_gRPC" in res:
            isChanged = isChanged or make_trojan_gRPC(res['trojan_gRPC'])
        if "VLESS_gRPC" in res:
            isChanged = isChanged or make_VLESS_gRPC(res['VLESS_gRPC'])
        if "VLESS_TCP" in res:
            isChanged = isChanged or make_VLESS_TCP(res['VLESS_TCP'])
        if "trojan_TCP" in res:
            isChanged = isChanged or make_trojan_TCP(res['trojan_TCP'])
        if "VLESS_WS" in res:
            isChanged = isChanged or make_VLESS_WS(res['VLESS_WS'])
        if "VMess_WS" in res:
            isChanged = isChanged or make_VMess_WS(res['VMess_WS'])
        if isChanged:
            os.system('systemctl restart xray')
    except Exception as e:
        print("********* Error:", e)
    time.sleep(30)
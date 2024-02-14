# -*- coding: utf-8 -*-
"""
Tool: Google Safe Browsing
Descripton: Check the Site’s Reputation
Author: Marcos Henrique
Version: 1.0
"""

import requests
import argparse
from prettytable import PrettyTable
from termcolor import colored
from colored import fg, attr
import os
import csv
import re
from tqdm import tqdm

def clear_screen():
    os.system('cls' if os.name == 'nt' else 'clear')

def parse_arguments():
    parser = argparse.ArgumentParser(description="Check if the website is Safe or Unsafe.")
    group = parser.add_mutually_exclusive_group(required=True)
    group.add_argument('-u', '--url', type=str, help="URL, e.g.: https://www.100security.com.br/")
    group.add_argument('-f', '--file', type=str, help="File containing URLs, e.g.: sites.txt")
    return parser.parse_args()
    
def get_http_status_code(url):
    try:
        response = requests.head(url, timeout=10)
        if response.status_code == 405:
            response = requests.get(url, timeout=10)
        return response.status_code
    except requests.RequestException:
        return '-'

def check_url(url, API_KEY, API_URL):
    payload = {
        'client': {'clientId': "100SECURITY", 'clientVersion': "1.0"},
        'threatInfo': {
            'threatTypes': ["MALWARE", "SOCIAL_ENGINEERING"],
            'platformTypes': ["ANY_PLATFORM"],
            'threatEntryTypes': ["URL"],
            'threatEntries': [{'url': url}]
        }
    }
    params = {'key': API_KEY}
    response = requests.post(API_URL, json=payload, params=params).json()
    http_code = get_http_status_code(url)
    
    if response.get('matches'):
        return (0, colored("Unsafe", 'red'), colored(url, 'red', 'on_grey'), http_code)
    return (1, colored("Safe", 'green'), colored(url, 'green', 'on_grey'), http_code)

def remove_ansi_codes(text):
    ansi_escape = re.compile(r'\x1b\[[0-9;]*m')
    return ansi_escape.sub('', text)

def main():
    clear_screen()
    args = parse_arguments()
    API_KEY = 'YOUR-API-HERE'
    API_URL = 'https://safebrowsing.googleapis.com/v4/threatMatches:find'
    results = []

    total_Safe = 0
    total_Unsafe = 0

    if args.url:
        result = check_url(args.url, API_KEY, API_URL)
        results.append(result)
        if result[0] == 1:
            total_Safe += 1
        else:
            total_Unsafe += 1
    elif args.file:
        try:
            with open(args.file, 'r') as file:
                urls = file.readlines()
                for url in tqdm(urls, desc="Processing URLs", unit="url"):
                    url = url.strip()
                    if url:
                        result = check_url(url, API_KEY, API_URL)
                        results.append(result)
                        if result[0] == 1:
                            total_Safe += 1
                        else:
                            total_Unsafe += 1
        except FileNotFoundError:
            print("File not found.")
            return
    clear_screen()
    results.sort(key=lambda x: (x[0], int(x[3]) if str(x[3]).isdigit() else 9999))

    header_table = PrettyTable()
    texto = f"{fg('yellow')}{attr('bold')}Google Safe Browsing{attr('reset')}"
    header_table.field_names = [texto]
    colored_text = "www.100security.com.br/" + colored("gsb", "yellow")
    header_table.add_row([colored_text])
    print(header_table)

    data_table = PrettyTable()
    data_table.field_names = ["Status", "Site", "HTTP Code"]
    data_table.align = "c"
    data_table.align["Site"] = "l"
    for _, status, url, http_code in results:
        data_table.add_row([status, url, http_code])
    
    print(data_table)
    
    if args.file:
        csv_filename = 'result.csv'
        with open(csv_filename, 'w', newline='', encoding='utf-8') as csvfile:
            csvwriter = csv.writer(csvfile)
            csvwriter.writerow(["Status", "Site", "HTTP Code"])
            for _, status, url, http_code in results:
                status_clean = remove_ansi_codes(status)
                url_clean = remove_ansi_codes(url)
                csvwriter.writerow([status_clean, url_clean, http_code])
        print(f"+ The results were saved in the " + colored("result.csv", "cyan") + " file.")

    print(f"\nTotal {colored('Unsafe ', 'red', 'on_grey')}: {colored(total_Unsafe, 'red')}")
    print(f"Total {colored('Safe ', 'green', 'on_grey')}: {colored(total_Safe, 'green')}")

if __name__ == "__main__":
    main()

print()
# -*- coding: utf-8 -*-
"""
Tool: Google Safe Browsing
Description: Check the Site’s Reputation with Multithreading
Author: Marcos Henrique
Version: 1.1
"""

import requests
import argparse
import concurrent.futures
from prettytable import PrettyTable
from termcolor import colored
from colored import fg, attr
import os
import re
import mysql.connector
from tqdm import tqdm

def clear_screen():
    os.system('cls' if os.name == 'nt' else 'clear')

def parse_arguments():
    parser = argparse.ArgumentParser(description="Check if the website is Safe or Unsafe using multithreading.")
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
        'client': {'clientId': "100SECURITY", 'clientVersion': "1.1"},
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
        return (0, "Unsafe", url, http_code)
    return (1, "Safe", url, http_code)

def remove_ansi_codes(text):
    ansi_escape = re.compile(r'\x1b\[[0-9;]*m')
    return ansi_escape.sub('', text)

def insert_results_into_db(cursor, status, url, http_code):
    insert_query = "INSERT INTO sites (status, site, http_code) VALUES (%s, %s, %s)"
    cursor.execute(insert_query, (status, url, http_code))

def check_urls(urls, API_KEY, API_URL, cursor):
    with tqdm(total=len(urls), desc="Processing URLs", unit="url") as progress_bar:
        with concurrent.futures.ThreadPoolExecutor(max_workers=10) as executor:
            future_to_url = {executor.submit(check_url, url, API_KEY, API_URL): url for url in urls}
            for future in concurrent.futures.as_completed(future_to_url):
                try:
                    status, description, url, http_code = future.result()
                    insert_results_into_db(cursor, description, url, http_code)
                except Exception as exc:
                    print('%r generated an exception: %s' % (url, exc))
                finally:
                    progress_bar.update(1)

def main():
    clear_screen()
    args = parse_arguments()
    API_KEY = 'YOUR-API-HERE'
    API_URL = 'https://safebrowsing.googleapis.com/v4/threatMatches:find'

    # MySQL connection setup
    try:
        conn = mysql.connector.connect(
            host='192.168.0.23',
            database='gsb',
            user='user',
            password='123456'
        )
        cursor = conn.cursor()
    except mysql.connector.Error as err:
        print(f"Error: {err}")
        return

    if args.url:
        status, description, url, http_code = check_url(args.url, API_KEY, API_URL)
        insert_results_into_db(cursor, description, url, http_code)
    elif args.file:
        try:
            with open(args.file, 'r') as file:
                urls = [url.strip() for url in file.readlines() if url.strip()]
            check_urls(urls, API_KEY, API_URL, cursor)
        except FileNotFoundError:
            print("File not found.")
            return

    conn.commit()
    cursor.close()
    conn.close()
    print("Results have been inserted into the database.")

if __name__ == "__main__":
    main()

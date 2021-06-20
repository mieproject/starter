#!/usr/bin/python3
import argparse, sys, re, requests
from datetime import datetime
from colorama import init
from termcolor import colored

# to run BASH cmds
import subprocess


# use Colorama to make init() Termcolor work on Windows too
init()

parser=argparse.ArgumentParser()

parser.add_argument('--project-name', '-n', help="project name", required=True)
parser.add_argument('--type', '-t', help="project type [web,api has also web]", type= str,default="web")
parser.add_argument('--auth', help="'y' if you need auth in ur project [y|n]", type= str,default="y")
parser.add_argument('--run-npm', help="'y' if you need to run `npm install && npm run dev` in ur project [y|n]", type= str,default="y")
# parser.add_argument('--packages','-p', help="all wanted packages separated by comma,", type= str)
parser.add_argument('--modules','-m', help="all wanted modules separated by comma,", type= str,default="")
args=parser.parse_args()




#helpers
def string_time():
  now = datetime.now()
  dt_string = now.strftime("%d/%m/%Y %H:%M:%S")
  return dt_string

def _info(s):
  print(colored('\r\n'+s+'\r','white','on_blue'))
def _err(s):
  print(colored('\r\n'+s+'\r','white','on_red'))
def make_safe_filename(s):
    def safe_char(c):
        if c.isalnum() or c=='.':
            return c
        else:
            return "_"

    safe = ""
    last_safe=False
    for c in s:
      if len(safe) > 200:
        return safe + "_" + str(time.time_ns() // 1000000)

      safe_c = safe_char(c)
      curr_safe = c != safe_c
      if not last_safe or not curr_safe:
        safe += safe_c
      last_safe=curr_safe
    return safe   


#init 

# datetime object containing current date and time

    
# project init
projects_path = '~/mieprojects'

pname = args.project_name
pfolder = projects_path+'/'+make_safe_filename(pname)
# pfolder = (pname)
# cd to project 
precmd = "cd "+pfolder+" && "

    
def main(): 
    # info:
    print(colored("- Project Name:"+pfolder, 'blue'))
    print(colored("- Project type:"+args.type, 'blue'))
    # start
    
    
    _info('['+string_time()+'] create new laravel project')
    subprocess.call('composer create-project laravel/laravel '+pfolder+'', shell=True)
    subprocess.call(precmd+"composer install ", shell=True)
    _info('start `install_packages`')
    install_packages()
    


    if(subprocess.call(['which','xdg-open']) == 0):
      subprocess.call('xdg-open '+pfolder,shell=True)
    #end main    
    #subprocess.call(precmd+"php artisan serv &&", shell=True) 

def install_packages():
  # check if this project need auth system
  if(args.auth == 'y'):
      subprocess.call(precmd+"composer require laravel/breeze --dev && php artisan breeze:install vue", shell=True)
      if(args.run_npm == 'y'):
        subprocess.call(precmd+"npm install && npm run dev", shell=True)
  
  if(args.modules != ''):
    modules_names = (args.modules).split(",")
    for module_name in modules_names:
      _info('['+string_time()+'] install module:'+ module_name)
      if(requests.get("https://packagist.org/packages/mieproject/"+module_name, allow_redirects=False).status_code == 200):
        subprocess.call(precmd+"composer require mieproject/"+ module_name, shell=True)
      else:
          _err('module "'+module_name+'" not exist')
          

  # packages_names = (args.packages).split(",")
  # print(packages_names)
  # for package_name in packages_names:
    # subprocess.call(precmd+"composer require "+ package_name, shell=True)
  


  

    
 
main()





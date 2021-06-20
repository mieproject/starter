#!/usr/bin/python3
# coding: utf-8
import argparse, sys, re, requests
from colorama import init
from termcolor import colored
# use Colorama to make init() Termcolor work on Windows too
init()
import mie_helpers
# to run BASH cmds
import subprocess



parser=argparse.ArgumentParser()

parser.add_argument('--project-name', '-n', help="project name", required=True)
parser.add_argument('--project-path', help="project path", required=False,default='~/mieprojects')
parser.add_argument('--type', '-t', help="project type [web,api has also web]", type= str,default="web")
parser.add_argument('--auth', help="'y' if you need auth in ur project [y|n]",choices=['y', 'n'], type= str,default="y")
parser.add_argument('--run-npm', help="'y' if you need to run `npm install && npm run dev` in ur project [y|n]",choices=['y', 'n'], type= str,default="y")
# parser.add_argument('--packages','-p', help="all wanted packages separated by comma,", type= str)
parser.add_argument('--modules','-m', help="all wanted modules separated by comma,", type= str,default="")
args=parser.parse_args()



#init 

# datetime object containing current date and time

    
# project init
projects_path = args.project_path

pname = args.project_name
pfolder = projects_path+'/'+mie_helpers.make_safe_filename(pname)
# pfolder = (pname)
# cd to project 
precmd = "cd "+pfolder+" && "

    
def main(): 
    # info:
    print(colored("- Project Name:"+pfolder, 'blue'))
    print(colored("- Project type:"+args.type, 'blue'))
    # start
    
    
    mie_helpers._info('['+mie_helpers.string_time()+'] create new laravel project')
    subprocess.call('composer create-project laravel/laravel '+pfolder+'', shell=True)
    subprocess.call(precmd+"composer install ", shell=True)
    mie_helpers._info('start `install_packages`')
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
      mie_helpers._info('['+mie_helpers.string_time()+'] install module:'+ module_name)
      if(requests.get("https://packagist.org/packages/mieproject/"+module_name, allow_redirects=False).status_code == 200):
        subprocess.call(precmd+"composer require mieproject/"+ module_name, shell=True)
      else:
          mie_helpers._err('module "'+module_name+'" not exist')
          

  # packages_names = (args.packages).split(",")
  # print(packages_names)
  # for package_name in packages_names:
    # subprocess.call(precmd+"composer require "+ package_name, shell=True)
  


  

    
 
main()





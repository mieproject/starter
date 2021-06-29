#!/usr/bin/python3
# coding: utf-8
import argparse, requests,glob
from pathlib import Path
from typing import DefaultDict
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
# parser.add_argument('--auth', help="'y' if you need auth in ur project [y|n]",choices=['y', 'n'], type= str,default="y")
parser.add_argument('--run-npm', help="'y' if you need to run `npm install && npm run dev` in ur project [y|n]",choices=['y', 'n'], type= str,default="y")
# parser.add_argument('--packages','-p', help="all wanted packages separated by comma,", type= str)
parser.add_argument('--modules','-m', help="all wanted modules separated by comma,", type= str)
args=parser.parse_args()



#init
packagist_path = 'https://packagist.org/packages/mieproject/'
github_path = 'https://github.com/mieproject/'
# datetime object containing current date and time

#test



# project init
projects_path = args.project_path
default_modules = ['project-initialization'];
modules_names = []
if((args.modules) != None): modules_names = (args.modules).split(",")
modules_names = list(set(default_modules) | set(modules_names))

# project info
pname = args.project_name
pfolder = projects_path+'/'+mie_helpers.make_safe_filename(pname)


# mierun_files
HOME_PATH = str(Path('~').expanduser())
str_glob_pattern = ('{}/vendor/mieproject/*/src/start.mierun'.format(pfolder)).replace('~',HOME_PATH)




# pfolder = (pname)
# cd to project
precmd = "cd "+pfolder+" && "

#test



def main():
    # info:
    print(colored("- Project Name:"+pfolder, 'blue'))
    print(colored("- Project type:"+args.type, 'blue'))
    # start



    mie_helpers._info('['+mie_helpers.string_time()+'] create new laravel project')
    subprocess.call('composer create-project laravel/laravel '+pfolder+'', shell=True)
    subprocess.call(precmd+"composer install ", shell=True)
    install_packages()

    print('generate_mierun_file')
    mierun_files = glob.glob(str_glob_pattern)
    mie_helpers.generate_mierun_file(mierun_files,precmd,str_glob_pattern)

    #create DB && seed
    subprocess.call(precmd+"php artisan migrate:fresh --seed", shell=True)

    # open progect folder as interface (if `xdg-open is exist`
    if(subprocess.call(['which','gnome-terminal']) == 0):
      subprocess.call('gnome-terminal --working-directory="{}"'.format(pfolder),shell=True)
    #end main
    #subprocess.call(precmd+"php artisan serv &&", shell=True)

def install_packages():
  # check if this project need auth system
  # if(args.auth == 'y'):
  if(False): # no need because of `settings` module
      subprocess.call(precmd+"composer require laravel/breeze --dev && php artisan breeze:install vue", shell=True)
      if(args.run_npm == 'y'):
        subprocess.call(precmd+"npm install && npm run dev", shell=True)

  if(modules_names != ''):
    mie_helpers._info('start `install_packages`')
    for module_name in modules_names:
      mie_helpers._info('['+mie_helpers.string_time()+'] install module:'+ module_name)
      if(requests.get(packagist_path+module_name, allow_redirects=False).status_code == 200): # if module exist
        subprocess.call(precmd+"composer require mieproject/{} dev-master".format(module_name), shell=True) # todo: remove  dev-master
      else:
        mie_helpers._err('module "{}" not exist'.format(module_name))










main()





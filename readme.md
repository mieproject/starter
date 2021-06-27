
## Requirement 
* [**python3**](https://www.python.org/download/releases/3.0/)
* [**composer**](https://getcomposer.org/) *(in linux use: `apt install composer`)*

## Install
```bash
git clone https://github.com/mieproject/starter
cd starter
pip install -r requirements.txt 
```

## Use
```bash
./mie.py
```
```bash
usage: mie.py [-h] --project-name PROJECT_NAME [--project-path PROJECT_PATH]
              [--type TYPE] [--auth {y,n}] [--run-npm {y,n}]
              [--modules MODULES]

optional arguments:
  -h, --help            show this help message and exit
  --project-name PROJECT_NAME, -n PROJECT_NAME
                        project name
  --project-path PROJECT_PATH
                        project path
  --type TYPE, -t TYPE  project type [web,api has also web]
  --auth {y,n}          'y' if you need auth in ur project [y|n]
  --run-npm {y,n}       'y' if you need to run `npm install && npm run dev` | todo: check it from mierun files
                        ur project [y|n]
  --modules MODULES, -m MODULES
                        all wanted modules separated by comma,

```
## Example 
```bash
./mie.py --project-name=blog
- Project Name:~/mieprojects/blog
- Project type:web

[20/06/2021 16:09:40] create new laravel project
Creating a "laravel/laravel" project at "../../../mieprojects/blog"
Installing laravel/laravel (v8.5.20)
  - Installing laravel/laravel (v8.5.20): Extracting archive
Created project in /home/anskal/mieprojects/blog
> @php -r "file_exists('.env') || copy('.env.example', '.env');"
Loading composer repositories with package information

```
